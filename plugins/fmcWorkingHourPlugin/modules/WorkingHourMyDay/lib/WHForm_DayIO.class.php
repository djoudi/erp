<?php

class WHForm_DayIO extends WorkingHourDayForm
{
    public function configure()
    {
        parent::configure();
        
        $this->useFields(array(
            'office_Entrance',
            'office_Exit'
        ));
        
        $this->setWidget('office_Entrance', new sfWidgetFormInputText());
        $this->setWidget('office_Exit', new sfWidgetFormInputText());
        
        $this->setValidator('office_Entrance', new sfValidatorString(array('required'=>true)));
        
    }
}
