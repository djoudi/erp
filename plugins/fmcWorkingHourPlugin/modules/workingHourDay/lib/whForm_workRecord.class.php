<?php

class whForm_workRecord extends WorkingHourRecordForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['day_id'],
            $this['recordType']
        );
        
        $this->validatorSchema ['end_Time'] = new sfValidatorTime(array('required' => true));
    }
    
}
