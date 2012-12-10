<?php

class whForm_newLeaveWReport extends LeaveRequestForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['user_id'],
            $this['type_id'],
            $this['status'],
            $this['day_Count'],
            $this['report_Received']
        );

        $this->setWidget('start_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));

        $this->setWidget('end_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));

        $this->setWidget('report_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setValidator('report_Date', new sfValidatorDate(array('required' => true)));
        
        $this->setValidator('report_Number', new sfValidatorString(array('max_length' => 50, 'required' => true)));
    }
    
}
