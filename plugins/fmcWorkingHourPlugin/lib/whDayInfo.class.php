<?php

class whDayInfo
{
    
    public static function isHoliday ($date)
    {
        $timestamp = strtotime($date);
        $dayoftheweek = date ("N", $timestamp);
        $result = true;
        
        if ($dayoftheweek > 5) // if weekend
        {
            $result = true;
        }
        elseif (Doctrine::getTable('Holiday')->findOneByDay($date)) // if holiday
        {
            $result = true;
        }
        else $result = false; // not holiday
        
        return $result;
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
    
    public static function routeDay ($date, $currentType = NULL, $user_id = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        
        if (!$date) $controller->redirect ($controller->genUrl('@homepage'));
        
        $dayType = Doctrine::getTable('WorkingHourDay')->getDateType ($date, $user_id);
        
        $redirectUrl = "";
        
        if ($dayType == "Leave")
        {
            if ($currentType != "Leave") 
            {
                $day = Doctrine::getTable('WorkingHourDay')->getActiveDate ($date, $user_id);
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
