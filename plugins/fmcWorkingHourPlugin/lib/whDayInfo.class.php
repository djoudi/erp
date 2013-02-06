<?php

class whDayInfo
{
    
    public static function getDayIORegular ($records)
    {
        $string = "";
        foreach ($records as $index=>$record)
        {
            if ($record['recordType']!="Work")
            {
                $string .= substr( $record['start_Time'] , 0 , 5 );
                
                if ($record['recordType']=="Entrance")
                {
                    $string .= "-";
                }
                elseif ( $index < (count($records)-1) )
                {
                    $string .= ", ";
                }
            }
        }
        return $string;
    }
    
    
    public static function isVacation ($date)
    {
        $result = (whDayInfo::isWeekend($date)) || (whDayInfo::isHoliday($date)) ? true : false;
        
        return $result;
    }
    
    
    
    public static function isWeekend ($date)
    {
        $timestamp = strtotime($date);
        $dayoftheweek = date ("N", $timestamp);
        
        $result = ($dayoftheweek > 5) ? true : false;
        
        return $result;
    }
    
    
    public static function isHoliday ($date)
    {
        $result = Doctrine::getTable('Holiday')->findOneByDay($date) ? true : false;
    }
    
    
    public static function getGoodDate ($date)
    {
        $output = date('Y-m-d, D', strtotime($date));
        if ($date == date('Y-m-d'))
            $output .= ' (Today)';
        elseif ($date == date('Y-m-d', strtotime('yesterday'))) 
            $output .= ' (Yesterday)';
        elseif ($date == date('Y-m-d', strtotime('tomorrow')))
            $output .= ' (Tomorrow)';
        return $output;
    }
    
    public static function routeDay ($date, $currentType = NULL, $employee_id = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        
        if (!$date) $controller->redirect ($controller->genUrl('@homepage'));
        
        $dayType = Doctrine::getTable('WorkingHourDay')->getDateType ($date, $employee_id);
        
        $redirectUrl = "";
        
        if ($dayType == "Leave")
        {
            if ($currentType != "Leave") 
            {
                $day = Doctrine::getTable('WorkingHourDay')->getActiveDate ($date, $employee_id);
                $redirectUrl = $controller->genUrl('@workingHourLeave_info?leave_id='.$day['leave_id']);
            }
        }
        elseif ($dayType == "Work")
        {
            if ($currentType != "Work") $redirectUrl = $controller->genUrl('@workingHourDay_work?date='.$date);
        }
        elseif ($dayType == "Empty")
        {
            if ($currentType != "New") $redirectUrl = $controller->genUrl('@workingHourDay_new?date='.$date);
        }
        
        if ($redirectUrl)
        {
            $controller->redirect ($redirectUrl);
        }
    }
    
}
