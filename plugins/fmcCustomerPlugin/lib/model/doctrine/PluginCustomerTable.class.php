<?php

class PluginCustomerTable extends Doctrine_Table
{
  
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginCustomer');
  }
  
  public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
  {
    parent::__construct($name, $conn, $initDefinition);
    $this->_options['orderBy'] = 'name ASC';
  }
  
  public function getOrdered()
  {
    return $this->CreateQuery('cfi')
      ->orderBy('name ASC')
      ->execute();
  }
}
