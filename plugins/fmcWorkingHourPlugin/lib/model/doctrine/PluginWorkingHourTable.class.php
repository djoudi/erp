<?php

class PluginWorkingHourTable extends Doctrine_Table
{
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginWorkingHour');
  }
  
  public function getByuseranddate ($user_id, $date)
  {
    return $this->CreateQuery ('wh')
      ->addWhere ('wh.user_id = ?', $user_id)
      ->addWhere ('wh.date = ?', $date)
      ->orderBy ('wh.start ASC')
      ->execute();
  }
}
