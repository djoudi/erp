<?php

class PluginCostFormItemTable extends Doctrine_Table {
    
    public static function getInstance() {
      
        return Doctrine_Core::getTable('PluginCostFormItem');
        
    }
    
    public function getActiveByProject($project_id) {
    
        return $this->CreateQuery('cfi')
            ->leftJoin('cfi.CostForms cf')
            ->where('cf.project_id = ?', $project_id)
            ->andWhere('cf.isSent = ?', true)
            ->andWhere('cfi.is_processed = ?', false)
            ->execute();
            
    }
    
}
