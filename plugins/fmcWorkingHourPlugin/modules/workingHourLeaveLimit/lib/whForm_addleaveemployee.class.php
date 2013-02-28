<?php

class whForm_addleaveemployee extends LeaveRequestEmployeeLimitForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['employee_id'],
            $this['added_by']
        );    
    }
    
}
