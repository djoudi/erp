<?php

class WorkingHourForm_User extends WorkingHourForm
{
  public function configure()
  {
    unset($this['user_id']);
    unset($this['date']);
    unset($this['time']);
    
    # new sfWidgetFormInputHidden(),
    $this->setWidget('time_started', new sfWidgetFormInputText());
    $this->setWidget('time_finished', new sfWidgetFormInputText());
  }
  
}
