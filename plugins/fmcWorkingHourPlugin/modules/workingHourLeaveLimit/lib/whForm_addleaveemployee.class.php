<?php

class whForm_addleaveemployee extends LeaveRequestEmployeeLimitForm
{
    
    public function configure()
    {
        // Inheriting parent configuration
        
        parent::configure();
        
        // Setting defaults
        
        $this->setDefaults(array(
            'added_by' => sfContext::getInstance()->getUser()->getGuardUser()->getId(), 
            'employee_id' => $this->getOption('employee_id')
        ));
        
        // Unsetting fields
        
        unset(
            $this['employee_id'],
            $this['added_by']
        );    
    }
    
}
