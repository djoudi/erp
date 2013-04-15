<?php

class whFilter_leaveRequest extends LeaveRequestFormFilter
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['status'],
            $this['start_Date'],
            $this['end_Date'],
            $this['comment'],
            $this['report_Date'],
            $this['report_Received']
        );
        
        $this->setWidget('employee_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Employee'), 
            'table_method' => 'getCurrentUsersDepartment', 
            'add_empty' => true
        )));
    }
    
}
