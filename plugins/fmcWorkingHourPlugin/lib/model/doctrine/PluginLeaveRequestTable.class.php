<?php

class PluginLeaveRequestTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginLeaveRequest');
    }
    
    public function getActiveLeave ($id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.id = ?', $id)
            ->addWhere ('l.status <> ?', 'Denied')
            ->addWhere ('l.user_id = ?', $user_id);
        
        return $q->fetchOne();
    }
    
    public function getDraftLeave ($id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.id = ?', $id)
            ->addWhere ('l.status = ?', 'Draft')
            ->addWhere ('l.user_id = ?', $user_id);
        
        return $q->fetchOne();
    }
    
    public function getRequestsForUser ($status = NULL, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('l')
            ->addWhere ('l.user_id = ?', $user_id);
        
        if ($status)
            $q->addWhere ('l.status = ?', $status);
        
        return $q->execute();
    }
    
}
