<?php

class WorkingHourForm_user_io extends WorkingHourForm
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
    unset($this['end']);
    
    $this->setWidget('start', new sfWidgetFormInputText());
    
    $this->widgetSchema['start']->setLabel('Enterance hour');
  }
  
}
