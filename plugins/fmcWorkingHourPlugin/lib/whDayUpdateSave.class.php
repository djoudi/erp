<?php

class whDayUpdateSave
{
    public static function updateBalance ($day)
    {
        $date = $day->getDate();
        $employee = $day->getEmployee();
        $workRecords = $day->getWorkingHourRecords();
        $leaveRequest = $day->getLeaveId() ? $day->getLeaveRequest() : NULL;
        
        $worked = 0;
        $required = 0;
        $leaveBalance = 0;
        $workDayTypeMultp = 1;
        
        /* Get employee available breaks */
        {
            if (!$breakLimit = $employee["required_daily_break_minutes"])
            {
                $breakLimit = Doctrine::getTable ("WorkingHourParameter")
                    ->findOneByParam("DefaultDailyBreaks")->getValue();
            }
        }
        
        /* Get Employee required minutes */
        {
            if (!$defaultRequired = $employee["required_daily_work_minutes"])
            {
                $defaultRequired = Doctrine::getTable ("WorkingHourParameter")
                    ->findOneByParam("DailyWorkHours")->getValue();
            }
        }
        
        /* Get required minutes for the day */
        {
            $dateObject = new DateTime ($date);
            
            if (! ($dateObject->format("N") > 5) ) // If not weekend
            {
                if ($isHoliday = is_object($holiday = Doctrine::getTable("Holiday")->findOneByDay($date))) // If holiday
                {
                    $required = $holiday->getHolidayType()=="Half-day" ? $defaultRequired/2 : 0;
                }
                else
                {
                    $required = $defaultRequired;
                }
            }
        }
        
        /* If a leave request */
        {
            if (is_object($leaveRequest))
            {
                $workDayTypeMultp = $leaveRequest->getIsHalfDay() ? 0.5 : 0;
                
                $worked += $defaultRequired * (1-$workDayTypeMultp);
            }   
        }
        
        /* Add the worked minutes */
        {
            foreach ($workRecords as $record)
            {
                if ($record["recordType"] == "Work")
                {
                    $worked += Fmc_Core_Time::getTimeDif($record["end_Time"], $record["start_Time"]) / 60;
                }
            }
        }
        
        /* Calculate breaks balance */
        {
            if ($workDayTypeMultp==1)
            {
                $leaveBalance = $breakLimit - $day["daily_Breaks"];
            }
            
        }
        
        return ($worked * $day["multiplier"]) + $leaveBalance - $required;
    }
}
