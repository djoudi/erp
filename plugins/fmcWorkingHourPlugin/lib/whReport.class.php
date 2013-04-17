<?php

class whReport
{
    
    public function BalanceResultsForDateInterval ($user_id, $startDate, $endDate)
    {
        $this->prepareEnvironment ($user_id, $startDate, $endDate);
        
        $upToDayBalanceClass = new whReport();
        $upToDayBalance = $upToDayBalanceClass->calculateEmployeeBalanceToDate ($user_id, $startDate);
        
        return $this->eachDayCalculations ($startDate, $endDate, true, $upToDayBalance);
    }
    
    
    public function calculateEmployeeBalanceToDate ($user_id, $endDate)
    {
        $startDate = $this->calculateStartDate ($user_id);
        
        // Fixing endDate up-to-date
        
        $endDate = new DateTime ($endDate);
        $endDate->sub (new DateInterval('P1D'));
        $endDate = $endDate->format("Y-m-d");
        
        $this->prepareEnvironment ($user_id, $startDate, $endDate);
        
        return $this->eachDayCalculations ($startDate, $endDate);
    }
    
    
    private function eachDayCalculations ($startDate, $endDate, $withResultsArray = false, $totalUserBalance = 0)
    {
        if ($withResultsArray) $results = array();
        
        $dayCounterStart = new DateTime ($startDate);
            
        $dayCounterEnd = new DateTime ($endDate);
        
        while ($dayCounterStart <= $dayCounterEnd)
        {
            $date = $dayCounterStart->format('Y-m-d');
            
            $workedMinutes = 0;
            
            $breaksBalance = 0;
            
            // Checking if user has day record
            
                if (($dayKey = array_search($date, $this->search_days)) !== FALSE) //if user has day record
                {
                    if ($this->db_employeedays[$dayKey]["leave_id"]) //if day is leave
                    {
                        if ($this->db_employeedays[$dayKey]["LeaveRequest"]["is_half_day"]) //if leave is half day
                        {
                            $workedMinutes += $this->parameters["DailyWorkHours"] / 2;
                        }
                        else //if leave is full day
                        {
                            $workedMinutes += $this->parameters["DailyWorkHours"];
                        }
                    }
                    else //day is work
                    {   
                        // adding day work records
                        
                            foreach ($this->db_employeedays[$dayKey]["WorkingHourRecords"] as $workRecord)
                            {
                                if ($workRecord["recordType"] == "Work")
                                {
                                    $workedMinutes += Fmc_Core_Time::getTimeDif( $workRecord["end_Time"], $workRecord["start_Time"]) / 60;
                                }
                            }
                        
                        // calculating breaks
                        
                            $breaksBalance = $this->parameters["DefaultDailyBreaks"] - $this->db_employeedays[$dayKey]["daily_Breaks"];
                    }
                    
                }
            
            // Calculating day results
                
                $requiredMinutes = $this->calculateRequiredMinutesToWork ($dayCounterStart, $date);
                
                $workedMinutesWithMultiplier = $workedMinutes * $this->db_employeedays[$dayKey]["multiplier"];
                
                $workBalance = $workedMinutesWithMultiplier - $requiredMinutes;
                
                $dayBalance = $workBalance + $breaksBalance;
                
                $totalUserBalance += $dayBalance;
            
            // 
            
                if ($withResultsArray)
                {
                    $results[$date]["date"] = $date;
                    $results[$date]["type"] = ($dayKey === FALSE) ? "-" : (($this->db_employeedays[$dayKey]["leave_id"]) ? "Leave" : "Work");
                    $results[$date]["multiplier"] = ($dayKey === FALSE) ? "-" : $this->db_employeedays[$dayKey]["multiplier"];
                    $results[$date]["minutesToWork"] = $requiredMinutes;
                    $results[$date]["workedMinutes"] = $workedMinutes;
                    $results[$date]["workBalance"] = $workBalance;
                    $results[$date]["usedBreaks"] = ($results[$date]["type"]=="Work") ? $this->db_employeedays[$dayKey]["daily_Breaks"] : "";
                    $results[$date]["breaksBalance"] = ($results[$date]["type"]=="Work") ? $breaksBalance : "";
                    $results[$date]["dayBalance"] = $dayBalance;
                    $results[$date]["balanceAfterThisday"] = $totalUserBalance;
                }
            
            // Iteration
                
                $dayCounterStart->add (new DateInterval('P1D'));
        }
        
        return $withResultsArray ? $results : $totalUserBalance;
    }
    
    
    private function calculateStartDate ($user_id) // DONE!
    {
        return "2013-01-01"; //@TODO: will be calculated after #17
    }
    
    
    private function prepareEnvironment ($user_id, $start_date, $end_date)
    {
        $this->db_holidays = Doctrine::getTable("Holiday")->findAll();
        
        $this->db_parameters = Doctrine::getTable("WorkingHourParameter")->findAll();
        
        $this->db_employeedays = Doctrine::getTable("WorkingHourday")
            ->createQuery ("whd")
            ->addWhere ("whd.employee_id = ?", $user_id)
            ->addwhere ("whd.date >= ?", $start_date)
            ->addWhere ("whd.date <= ?", $end_date)
            ->leftJoin ("whd.LeaveRequest lr")
            ->leftJoin ("whd.WorkingHourRecords whr")
                ->leftJoin ("whr.Project p")
                ->leftJoin ("whr.WorkType w")
            ->orderBy ("whd.date ASC, whr.start_Time ASC")
            ->execute();
        
        $this->search_holiday = array();
        
            foreach ($this->db_holidays as $holiday) array_push ($this->search_holiday, $holiday["day"]);
        
        $this->search_days = array();
        
            foreach (($this->db_employeedays) as $day) array_push ($this->search_days, $day["date"]);
        
        $this->parameters = array();
        
            foreach (($this->db_parameters) as $parameter) $this->parameters[$parameter["param"]] = $parameter["value"];
    }
    
    
    private function HolidayMultiplier ($date)
    {
        if (($holidayKey = array_search($date, $this->search_holiday)) !== FALSE) //if holiday
        {
            $result = ($this->db_holidays[$holidayKey]["holiday_type"]=="Full-day") ? 0 : 0.5;
        }
        else $result = 1;
        
        return $result;
    }
    
    
    private function isWeekend ($dayObject)
    {
        return ($dayObject->format("N") > 5) ? 1 : 0;
    }
    
    
    private function calculateRequiredMinutesToWork ($dayObject, $date)
    {
        if ($this->isWeekend ($dayObject))
        {
            $result = 0;
        }
        else
        {
            $result = $this->parameters["DailyWorkHours"] * $this->HolidayMultiplier($date);
        }
        
        return $result;
    }
}
