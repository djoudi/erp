<?php

class whForm_entranceRecord extends WorkingHourRecordForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['end_Time'],
            $this['project_id'],
            $this['work_Type_id']
        );
        
        $this->widgetSchema['start_Time']->setLabel('Office Entrance');
    }
    
}
