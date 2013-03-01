<?php

class Form_Parameter_Leave extends WorkingHourParameterForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['param'],
            $this['value']
        );
    }
    
}
