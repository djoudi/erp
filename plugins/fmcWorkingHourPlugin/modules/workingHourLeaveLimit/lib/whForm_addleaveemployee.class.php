<?php

class whForm_addleaveemployee extends LeaveRequestEmployeeLimitForm
{
    public function configure()
    {
        parent::configure();
        
        $user = sfContext::getInstance()->getUser();
        
        $this->setDefaults(array(
            'added_by' => $user->getGuardUser()->getId(), 
            'employee_id' => $this->getOption('employee_id')
        ));
        
        #echo ;
        
        #$this->setWidgets(array(
          // widgets
          #'employee_id' => new sfWidgetFormTextArea(array('default' => $text)),
          // widgets
        #));
        
        
        
        unset(
            $this['employee_id'],
            $this['added_by']
        );
        
    }
}
