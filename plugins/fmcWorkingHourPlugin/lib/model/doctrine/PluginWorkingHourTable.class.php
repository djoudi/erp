<?php

class PluginWorkingHourTable extends Doctrine_Table
{
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginWorkingHour');
  }
  
  public function getUserHoursToday($user_id)
  {
    return $this->CreateQuery('wh')
      ->addWhere('wh.user_id = ?', $user_id)
      ->addWhere('wh.date = ?', date('Y-m-d'))
      ->execute();
  }
}
