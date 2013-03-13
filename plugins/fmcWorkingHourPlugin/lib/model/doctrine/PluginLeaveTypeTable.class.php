<?php

class PluginLeaveTypeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginLeaveType');
    }
    
    public function getNotYearly()
    {
        $q = $this->CreateQuery('lt')
            ->addWhere('lt.yearly_Limit IS NULL');
        
        return $q->execute();
    }
}
