<?php

class PluginProjectTable extends Doctrine_Table
{
  
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginProject');
    }
    
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
    {
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'code ASC';
    }
    
    public function getAll()
    {
        return $this->CreateQuery('p')
        ->orderBy('p.code ASC')
        ->execute();
    } 
    
    public function getActive()
    {
        return $this->CreateQuery('p')
            ->where('p.status = ?', 'Active')
            ->orderBy('p.code ASC')
            ->execute();
    }
    
}
