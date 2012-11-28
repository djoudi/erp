<?php

class workingHourStatus
{
        
    public static function routeDay ($date, $currentType = NULL, $user_id = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        
        if (!$date) $controller->redirect ($controller->genUrl('@homepage'));
        
        $dayType = Doctrine::getTable('WorkingHourDay')->getDateType ($date, $user_id);
        
        $redirectUrl = "";
        
        if ($dayType == "Leave")
        {
            if ($currentType != "Leave") $redirectUrl = $controller->genUrl('@homepage?date='.$date);
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
