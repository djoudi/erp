<?php

class Form_Parameter extends WorkingHourParameterForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['param'],
            $this['value_leavetype_id']
        );
    }
    
}
