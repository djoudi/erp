<?php

class Form_WHEntranceExit_newday extends WorkingHourEntranceExitForm
{
    public function configure()
    {
        unset($this['day_id']);
        unset($this['type']);
        
        $this->setWidget('time', new sfWidgetFormInputText());
        $this->widgetSchema['time']->setLabel('Office entrance');
        $this->setDefault('time', "09:00"); 
    }  	
}
