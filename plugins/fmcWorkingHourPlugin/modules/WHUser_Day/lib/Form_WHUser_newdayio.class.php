<?php

class Form_WHUser_newdayio extends WorkingHourEntranceExitForm
{
    public function configure()
    {
        parent::configure();
        
        unset($this['day_id']);
        unset($this['type']);
        
        $this->setWidget('time', new sfWidgetFormInputText());
        
    }  	
}
