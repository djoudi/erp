<?php


class PluginCurrencyTable extends Doctrine_Table
{
  
  public static function getInstance()
  {
      return Doctrine_Core::getTable('PluginCurrency');
  }
  
  public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
  {
    parent::__construct($name, $conn, $initDefinition);
    $this->_options['orderBy'] = 'code ASC';
  }
  
  public function getActive()
  {
    return $this->CreateQuery('c')
      ->where('c.isActive = ?', true)
      ->orderBy('c.code ASC')
      ->execute();
  }
  
}
