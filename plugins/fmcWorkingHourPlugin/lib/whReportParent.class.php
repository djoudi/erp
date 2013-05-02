<?php

class whReportParent
{
    // Initializing
        
        public function __construct()
        {
            $this->db_holidays = Doctrine::getTable("Holiday")->findAll();
            
            $this->db_parameters = Doctrine::getTable("WorkingHourParameter")->findAll();
            
            $this->search_holiday = array();
            foreach ($this->db_holidays as $holiday) array_push ($this->search_holiday, $holiday["day"]);
            
            $this->parameters = array();
            foreach (($this->db_parameters) as $parameter) $this->parameters[$parameter["param"]] = $parameter["value"];
        }
    
    
    // Getters and setters
        
        public function getUpToDayBalance ()
        {
            return $this->upToDayBalance;
        }
            
    
    // Help functions for calculating
        
        public function isWeekend ($dayObject)
        {
            return ($dayObject->format("N") > 5) ? 1 : 0;
        }
        
        public function getEmployeeMinutes ($employee)
        {
            if (!$value = $employee["required_daily_work_minutes"])
                $value = $this->parameters["DailyWorkHours"];
            
            return $value;
        }
        
        public function getEmployeeBreaks ($employee)
        {
            if (!$value = $employee["required_daily_break_minutes"])
                $value = $this->parameters["DefaultDailyBreaks"];
            
            return $value;
        }
        
        public function getMultiplier ($date)
        {
            if (($holidayKey = array_search($date, $this->search_holiday)) !== FALSE) //if holiday
            {
                $multiplier = ($this->db_holidays[$holidayKey]["holiday_type"]=="Full-day") ? 0 : 0.5;
            }
            else $multiplier = 1;
            
            return $multiplier;
        }
        
        public function getRequiredMinutes ($dayObject, $date, $employee)
        {
            return $this->isWeekend($dayObject) ? 0 : $this->getEmployeeMinutes($employee) * $this->getMultiplier($date);
        }
    
    // Calculating
    
        private function calculateBalanceForDateIntervalAndEmployee (
            $from, $to, $employee, $days, $daySearch, $totalBalance = 0, $withArray = false
        )
        {
            $this->resultArray = array();
            
            $dayCounterStart = new DateTime ($from);
            $dayCounterStart->sub (new DateInterval('P1D'));
            $dayCounterEnd = new DateTime ($to);
            
            while ($dayCounterStart->add (new DateInterval('P1D')) <= $dayCounterEnd)
            {
                $date = $dayCounterStart->format('Y-m-d');
                
                $dayType = "";
                $dayMultiplier = "";
                $dayWorkedMinutes = 0;
                $dayWorkedMinutesWithMultiplier = 0;
                $dayBreaksBalance = 0;
                
                $dayRequiredMinutes = $this->getRequiredMinutes ($dayCounterStart, $date, $employee);
                
                // Checking if user has day record
                
                    if (($dayKey = array_search($date, $daySearch)) !== FALSE) //if user has day record
                    {
                        $day = $days[$dayKey]; // use this -----------------
                        
                        if ($day["leave_id"]) //if day is leave
                        {
                            $dayType = "Leave";
                            
                            if ($day["LeaveRequest"]["is_half_day"]) //if leave is half day
                            {
                                $dayWorkedMinutes += $this->getEmployeeMinutes($employee) / 2;
                            }
                            else //if leave is full day
                            {
                                $dayWorkedMinutes += $this->getEmployeeMinutes($employee);
                            }
                        }
                        else //day is work
                        {   
                            $dayType = "Work";
                            
                            $dayMultiplier = $day["multiplier"];
                            
                            $dayBreaksBalance = $this->getEmployeeBreaks ($employee) - $day["daily_Breaks"];
                            
                            // adding day work records
                            
                            foreach ($day["WorkingHourRecords"] as $workRecord)
                            {
                                if ($workRecord["recordType"] == "Work")
                                {
                                    $dayWorkedMinutes += Fmc_Core_Time::getTimeDif( $workRecord["end_Time"], $workRecord["start_Time"]) / 60;
                                }
                            }
                        }
                        
                    }
                
                // Calculating day results
                
                    $dayWorkedMinutesWithMultiplier = $dayWorkedMinutes * $dayMultiplier;
                    $workBalance = $dayWorkedMinutesWithMultiplier - $dayRequiredMinutes;
                    $dayBalance = $workBalance + $dayBreaksBalance;
                    $totalBalance += $dayBalance;
                
                // Preparing array
                
                    if ($withArray)
                    {
                        $this->resultArray[$date]["date"] = $date;
                        $this->resultArray[$date]["type"] = $dayType;
                        $this->resultArray[$date]["multiplier"] = $dayMultiplier;
                        $this->resultArray[$date]["minutesToWork"] = $dayRequiredMinutes;
                        $this->resultArray[$date]["workedMinutes"] = $dayWorkedMinutes;
                        $this->resultArray[$date]["workBalance"] = $workBalance;
                        $this->resultArray[$date]["usedBreaks"] = $dayType=="Work" ? $day["daily_Breaks"] : "" ;
                        $this->resultArray[$date]["breaksBalance"] = $dayBreaksBalance;
                        $this->resultArray[$date]["dayBalance"] = $dayBalance;
                        $this->resultArray[$date]["balanceAfterThisday"] = $totalBalance;
                    }
            }
            
            return $totalBalance;
        }
    
    
}
