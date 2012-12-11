<?php

class whFilter_leaveRequest extends LeaveRequestFormFilter
{
    
    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema['user_id']->setLabel('Employee');
        
        $this->widgetSchema['type_id']->setLabel('Leave Type');
        
        unset(
            $this['status'],
            $this['start_Date'],
            $this['end_Date'],
            $this['comment'],
            $this['report_Date'],
            $this['report_Received']
        );
    }
    
}
