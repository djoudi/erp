<?php

class PluginVatTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginVat');
    }
      
    public function getActive()
    {
        return $this->CreateQuery('v')
            ->where('v.isActive = ?', true)
            ->execute();
    }
    
}
