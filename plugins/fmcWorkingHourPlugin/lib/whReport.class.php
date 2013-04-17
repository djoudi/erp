<?php

class whReport
{
    public function calculateEmployeeBalanceToDate ($user_id, $endDate)
    {
        $this->prepareDates ($user_id, $endDate);
        
        $this->prepareDatabase ($user_id);
        
        $dayCounterStart = new DateTime ($this->global_startDate);
        
        $dayCounterEnd = new DateTime ($this->global_endDate);
        
        $this->totalUserBalance = 0;
        
        
        while ($dayCounterStart <= $dayCounterEnd)
        {
            $date = $dayCounterStart->format('Y-m-d');
            $workedMinutes = 0;
            $workedMinutesWithMultiplier = 0;
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
                
                $this->totalUserBalance += $dayBalance;
                
            // iteration
                
                $dayCounterStart->add (new DateInterval('P1D'));
        }
        
        return $this->totalUserBalance;
    }
    
    
    private function prepareDates ($user_id, $endDate)
    {
        $this->db_employee = Doctrine::getTable("sfGuardUser")->findOneById ($user_id);
                
        $this->global_startDate = "2013-01-01";  //@TODO: will be calculated after #17
        
        $this->global_endDate = $endDate;
    }
    
    
    private function prepareDatabase ($user_id)
    {
        $this->db_holidays = Doctrine::getTable("Holiday")->findAll();
        
        $this->db_parameters = Doctrine::getTable("WorkingHourParameter")->findAll();
        
        $this->db_employeedays = Doctrine::getTable("WorkingHourday")
            ->createQuery ("whd")
            ->addWhere ("whd.employee_id = ?", $this->db_employee["id"])
            ->addwhere ("whd.date >= ?", $this->global_startDate)
            ->addWhere ("whd.date <= ?", $this->global_endDate)
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
