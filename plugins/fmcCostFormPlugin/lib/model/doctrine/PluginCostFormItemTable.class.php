<?php

class PluginCostFormItemTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginCostFormItem');
    }
    
    public function getByIdUser ($id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('cfi')
            ->leftJoin('cfi.CostForms cf')
            ->addWhere ('cfi.id = ?', $id)
            ->addWhere ('cf.employee_id = ?', $employee_id);
        
        return $q->fetchOne();
    }
    
}
