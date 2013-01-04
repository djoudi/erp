<?php

class PluginLeaveRequestTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginLeaveRequest');
    }
    
    
    public function getWithIdAndStatus ($id, $status = NULL)
    {
        $q = $this->createQuery ('l')
            ->addWhere ('l.id = ?', $id);
        
        if ($status)
            $q->addWhere ('l.status = ?', $status);
        
        return $q->fetchOne();
    }
    
    
    public function getActiveLeave ($id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.id = ?', $id)
            ->addWhere ('l.status <> ?', 'Denied')
            ->addWhere ('l.employee_id = ?', $employee_id);
        
        return $q->fetchOne();
    }
    
    public function getDraftLeave ($id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.id = ?', $id)
            ->addWhere ('l.status = ?', 'Draft')
            ->addWhere ('l.employee_id = ?', $employee_id);
        
        return $q->fetchOne();
    }
    
    public function getRequestsForUser ($status = NULL, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.employee_id = ?', $employee_id);
        
        if ($status)
            $q->addWhere ('l.status = ?', $status);
        
        return $q->execute();
    }
    
}
