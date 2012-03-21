<?php

abstract class PluginWorkingHour extends BaseWorkingHour
{
  public function getTimeDifference()
  {
    $start = strtotime($this->getStart());
    $end = strtotime($this->getEnd());
    $minute = ( ($end-$start) / 60 ) % 60;
    $hour = ( ( ($end-$start) / 60 ) - $minute ) / 60;
    return $hour."h ".$minute."m";
  }
  
  public function getNexthour()
  {
    $item = Doctrine::getTable('WorkingHour')
      ->createQuery('wh')
      ->addWhere('wh.date = ?', $this->getDate())
      ->orderBy('wh.end DESC')
      ->fetchOne()
    ;
    if (!$item) echo "koooo";
    return $item->getEnd();
    
  }
}
