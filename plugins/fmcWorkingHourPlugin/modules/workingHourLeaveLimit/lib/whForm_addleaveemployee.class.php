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
        
        $this->widgetSchema['type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('LeaveType'), 
            'table_method' => 'getNotYearly', 
            'add_empty' => false
        ));
    }
    
}
