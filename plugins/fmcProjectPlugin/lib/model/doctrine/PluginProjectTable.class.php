<?php

class PluginProjectTable extends Doctrine_Table
{
  
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginProject');
    }
    
    public function getActive()
    {
        $q = $this->CreateQuery('p')
            ->addWhere('p.status = ?', 'Active');
        
        return $q->execute();
    }
    
    public function getActiveById ($id)
    {
        $q = $this->CreateQuery('p')
            ->addWhere ('p.status = ?', 'Active')
            ->addWhere ('p.id = ?', $id)
            ->limit(1);
        
        return $q->fetchOne();
    }
    
    public function prepareInvoicingFilter ($project_id, $limit)
    {
        $q = Doctrine::getTable('CostFormItem')
            ->createQuery('cfi')
            ->innerJoin ('cfi.Vats v')
            ->innerJoin ('cfi.Currencies c')
            ->innerJoin('cfi.CostForms cf')
            ->innerJoin ('cf.Users u')
            ->where('cf.project_id = ?', $project_id)
            ->andWhere('cf.isSent = ?', true)
            ->andWhere('cfi.is_processed = ?', false)
            ->limit ($limit);
        return $q;
    }
    
}
