<?php

abstract class PluginWorkingHour extends BaseWorkingHour
{
  public function getTimeDifference()
  {
    $start = strtotime($this->getTimeStarted());
    $end = strtotime($this->getTimeFinished());
    $minute = ( ($end-$start) / 60 ) % 60;
    $hour = ( ( ($end-$start) / 60 ) - $minute ) / 60;
    return $hour."h ".$minute."m";
  }
}
