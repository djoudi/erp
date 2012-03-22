<?php

class PluginVatTable extends Doctrine_Table
{
  
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginVat');
  }
  
  public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
  {
    parent::__construct($name, $conn, $initDefinition);
    $this->_options['orderBy'] = 'rate ASC';
  }
  
  public function getActive()
  {
    return $this->CreateQuery('v')
      ->where('v.isActive = ?', true)
      ->orderBy('v.rate ASC')
      ->execute();
  }
}
