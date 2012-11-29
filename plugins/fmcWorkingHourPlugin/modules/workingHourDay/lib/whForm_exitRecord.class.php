<?php

class whForm_exitRecord extends WorkingHourRecordForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['day_id'],
            $this['recordType'],
            $this['end_Time'],
            $this['project_id'],
            $this['work_Type_id']
        );
        
        $this->widgetSchema['start_Time'] = new sfWidgetFormInputText();
        
        $this->widgetSchema['start_Time']->setLabel('Office Exit');
    }
    
}
