<?php

class whForm_workRecord extends WorkingHourRecordForm
{
    
    public function configure()
    {
        parent::configure();
        
        $this->validatorSchema ['end_Time'] = new sfValidatorTime(array('required' => true));
    }
    
}
