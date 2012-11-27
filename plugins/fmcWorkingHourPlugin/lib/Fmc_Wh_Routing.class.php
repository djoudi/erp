<?php

class Fmc_Wh_Routing
{
    
    public static function CheckDay ($date, $currentType = NULL, $user_id = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        
        if (!$date) $controller->redirect ($controller->genUrl('@homepage'));
        
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $status = Doctrine::getTable('WorkingHourDay')->getTypeForUserDate ($user_id, $date);
        
        $redirectUrl = "";
        
        if ($status == "Leave")
        {
            if ($currentType != "Leave") $redirectUrl = $controller->genUrl('@homepage?date='.$date);
        }
        elseif ($status == "Work")
        {
            if ($currentType != "Work") $redirectUrl = $controller->genUrl('@wh_myday_work?date='.$date);
        }
        elseif ($status == "Empty")
        {
            if ($currentType != "New") $redirectUrl = $controller->genUrl('@wh_myday_new?date='.$date);
        }
        
        if ($redirectUrl)
        {
            $controller->redirect ($redirectUrl);
        }
    }
    
}
