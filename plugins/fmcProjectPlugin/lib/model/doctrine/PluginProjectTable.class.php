<?php

class PluginProjectTable extends Doctrine_Table
{
  
  public static function getInstance()
  {
      return Doctrine_Core::getTable('PluginProject');
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
