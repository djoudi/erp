<?php

class WorkingHourForm_user_exit extends WorkingHourForm
{
  public function configure()
  {
    unset($this['type']);
    unset($this['user_id']);
    unset($this['date']);
    unset($this['time']);
    unset($this['worktype_id']);
    unset($this['project_id']);
    unset($this['comment']);
    unset($this['start']);
    
    $this->setWidget('end', new sfWidgetFormInputText());
    
    $this->widgetSchema['end']->setLabel('Exit hour');
  }
  
}
