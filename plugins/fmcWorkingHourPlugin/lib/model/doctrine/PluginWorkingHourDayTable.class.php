<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    
    public function getWithIdAndStatus ($id, $status = NULL)
    {
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.id = ?', $id);
        
        if ($status)
            $q->addWhere ('whd.status = ?', $status);
        
        return $q->fetchOne();
    }
    
    
    public function getDraftDate ($date, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status = ?', 'Draft');
        return $q->fetchOne();
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
