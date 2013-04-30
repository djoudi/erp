<?php

class whReport
{
    
    private function getDaysFromDB ($start_date, $end_date)
    {
        $this->db_employeedays = Doctrine::getTable("WorkingHourday")
            ->createQuery ("whd")
            ->addWhere ("whd.employee_id = ?", $this->db_employee->getId())
            ->addwhere ("whd.date >= ?", $start_date)
            ->addWhere ("whd.date <= ?", $end_date)
            ->leftJoin ("whd.LeaveRequest lr")
            ->leftJoin ("whd.WorkingHourRecords whr")
                ->leftJoin ("whr.Project p")
                ->leftJoin ("whr.WorkType w")
            ->orderBy ("whd.date ASC, whr.start_Time ASC")
            ->execute();
        
        $this->search_days = array();
        foreach (($this->db_employeedays) as $day) array_push ($this->search_days, $day["date"]);
    }
    
    
    private function getGlobals ($user_id)
    {
        if (!isset($this->globalsAreSet))
        {
            $this->db_employee = Doctrine::getTable("sfGuardUser")->findOneById ($user_id);
            
            $this->db_holidays = Doctrine::getTable("Holiday")->findAll();
            
            $this->db_parameters = Doctrine::getTable("WorkingHourParameter")->findAll();
            
            $this->search_holiday = array();
            foreach ($this->db_holidays as $holiday) array_push ($this->search_holiday, $holiday["day"]);
            
            $this->parameters = array();
            foreach (($this->db_parameters) as $parameter) $this->parameters[$parameter["param"]] = $parameter["value"];
            
            $this->globalsAreSet = true;
        }
    }
    
    
    public function getUpToDayBalance()
    {
        return $this->upToDayBalance;
    }
    
    
    public function BalanceResultsForDateInterval ($user_id, $startDate, $endDate)
    {
        $this->getGlobals ($user_id);
        
        $this->getDaysFromDB ($startDate, $endDate);
        
        $upToDayBalanceClass = new whReport();
        $this->upToDayBalance = $upToDayBalanceClass->calculateEmployeeBalanceToDate ($user_id, $startDate);
        
        return $this->eachDayCalculations ($startDate, $endDate, true, $this->upToDayBalance);
    }
    
    
    public function calculateEmployeeBalanceToDate ($user_id, $endDate)
    {
        $this->getGlobals ($user_id);
        
        $startDate = max (array("2013-01-01", $this->db_employee->getEmploymentStart()));
        $endDate = new DateTime ($endDate);
        $endDate->sub(new DateInterval('P1D'))->format("Y-m-d"); // One day before the given end date
        $endDate = $endDate->format("Y-m-d");
        
        $this->getDaysFromDB ($startDate, $endDate);
        
        return $this->db_employee->getWh_balance_before_2013() + $this->eachDayCalculations ($startDate, $endDate);
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
                            $workedMinutes += $this->getEmployeeRequiredDailyHours() / 2;
                        }
                        else //if leave is full day
                        {
                            $workedMinutes += $this->getEmployeeRequiredDailyHours();
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
                        
                            $breaksBalance = $this->getEmployeeAvailableDailyBreaks() - $this->db_employeedays[$dayKey]["daily_Breaks"];
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
    
    
    private function isWeekend ($dayObject)
    {
        return ($dayObject->format("N") > 5) ? 1 : 0;
    }
    
    
    private function getEmployeeRequiredDailyHours ()
    {
        if (!$value = $this->db_employee->getRequired_daily_work_minutes())
            $value = $this->parameters["DailyWorkHours"];
        
        return $value;
    }
    
    
    private function getEmployeeAvailableDailyBreaks ()
    {
        if (!$value = $this->db_employee->getRequired_daily_break_minutes())
            $value = $this->parameters["DefaultDailyBreaks"];
        
        return $value;
    }
    
    
    private function calculateRequiredMinutesToWork ($dayObject, $date)
    {
        if (($holidayKey = array_search($date, $this->search_holiday)) !== FALSE) //if holiday
        {
            $holidayMultiplier = ($this->db_holidays[$holidayKey]["holiday_type"]=="Full-day") ? 0 : 0.5;
        }
        else $holidayMultiplier = 1;
                
        if ($this->isWeekend ($dayObject))
        {
            $result = 0;
        }
        else
        {
            $result = $this->getEmployeeRequiredDailyHours() * $holidayMultiplier;
        }
        
        return $result;
    }
}
