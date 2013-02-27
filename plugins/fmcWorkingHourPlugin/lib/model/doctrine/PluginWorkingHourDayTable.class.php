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
    
    public function getDraftDate ($date, $employee_id = NULL, $admin = false)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('whd')
            ->addWhere ('status = ?', 'Draft')
            ->addWhere ('whd.date = ?', $date);
        
        if (!$admin) $q->addWhere ('whd.employee_id = ?', $employee_id);
        
        return $q->fetchOne();
    }
    
    public function getActiveDate ($date, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.employee_id = ?', $employee_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status <> ?', 'Denied');
        return $q->fetchOne();
    }
    
    
    public function getDateType ($date, $employee_id = NULL)
    {
        if ( $whday = $this->getActiveDate ($date, $employee_id) )
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
