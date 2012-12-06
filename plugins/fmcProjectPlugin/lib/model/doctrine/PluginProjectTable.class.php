<?php

class PluginProjectTable extends Doctrine_Table
{
  
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginProject');
    }
    
    public function getActive()
    {
        return $this->CreateQuery('p')
            ->where('p.status = ?', 'Active')
            ->execute();
    }
    
}
