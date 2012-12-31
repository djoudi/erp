<?php

class PluginCostFormTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginCostForm');
    }    
    
    public function ReportListEmployees ()
    {
        return Doctrine::getTable ('sfGuardUser')->getActive();
    }
    
    public function ReportListProjects ()
    {
        return Doctrine::getTable ('Project')->getActive();
    }
    
    public function getByIdUser ($id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('cf')
            ->addWhere ('cf.id = ?', $id)
            ->addWhere ('cf.user_id = ?', $user_id);
        
        return $q->fetchOne();
    }
    
}
