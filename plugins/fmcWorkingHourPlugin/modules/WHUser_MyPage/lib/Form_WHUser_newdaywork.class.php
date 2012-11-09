<?php

class Form_WHUser_newdaywork extends WorkingHourWorkForm
{
    public function configure()
    {
        parent::configure();
        
        unset($this['day_id']);
        
        $this->setWidget('start', new sfWidgetFormInputText());
        $this->setWidget('end', new sfWidgetFormInputText());
    }  	
}
