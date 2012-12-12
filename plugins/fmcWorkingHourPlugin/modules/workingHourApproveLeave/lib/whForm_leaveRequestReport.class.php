<?php

class whForm_leaveRequestReport extends LeaveRequestForm
{
    
    public function configure()
    {
        parent::configure();
        
        $this->useFields(array(
            'report_Date', 
            'report_Number', 
            'report_Received'
        ));
        
        $this->setWidget('report_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('report_Received', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
    }
    
}
