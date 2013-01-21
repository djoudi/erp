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
    
    public function prepareInvoicingQuery ($invoicing_id, $dni)
    {
        $q = $this->createQuery ('cfi')
            ->leftJoin ('cfi.Currencies cur')
            ->leftJoin ('cfi.CostForms cf')
            ->leftJoin ('cf.Projects p')
            ->leftJoin ('cfi.CostFormInvoicingItems cfinvitem')
            ->leftJoin ('cfinvitem.CostFormInvoicing cfinv')
            ->addWhere ('cfi.dontInvoice = ?', $dni)
            ->addWhere ('cfinv.id = ?', $invoicing_id);
        
        return $q->execute();
    }
    
}
