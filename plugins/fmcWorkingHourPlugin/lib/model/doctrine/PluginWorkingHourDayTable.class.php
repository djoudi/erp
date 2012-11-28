<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    public function getActiveDate ($date, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status <> ?', 'Denied');
        return $q->fetchOne();
    }
    
    public function getDateType ($date, $user_id = NULL)
    {
        if ( $whday = $this->getActiveDate ($date, $user_id) )
        {
            
            if ($whday['leave_id']) $status = "Leave";
            else $status = "Work";
        }
        else
        {
            $status = "Empty";
        }
        return $status;
    }
    
}
