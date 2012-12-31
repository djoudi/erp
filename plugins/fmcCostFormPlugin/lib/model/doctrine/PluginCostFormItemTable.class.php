<?php

class PluginCostFormItemTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginCostFormItem');
    }
    
    public function getByIdUser ($id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('cfi')
            ->leftJoin('cfi.CostForms cf')
            ->addWhere ('cfi.id = ?', $id)
            ->addWhere ('cf.user_id = ?', $user_id);
        
        return $q->fetchOne();
    }
    
}
