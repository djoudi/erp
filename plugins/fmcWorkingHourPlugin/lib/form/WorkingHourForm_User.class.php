<?php

class WorkingHourForm_User extends WorkingHourForm
{
  public function configure()
  {
    unset($this['user_id']);
    unset($this['date']);
    unset($this['time']);
  }
}
