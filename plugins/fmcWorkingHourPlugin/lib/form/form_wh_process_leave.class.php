<?php

class form_wh_process_leave extends PluginWorkingHourLeaveForm {
    
    public function configure() {
        
        unset($this['status_user']);
        
        $this->widgetSchema->setLabel('user_id', "Employee");
        $this->widgetSchema->setLabel('type', "Leave Type");
        
        $this->setWidget('type', new sfWidgetFormChoice(
            array(
                'choices' => array(
                    'IllnessWReport' => 'Illness (with Report)', 
                    'IllnessWoReport' => 'Illness (without Report)', 
                    'PaidVacation' => 'Paid Vacation', 
                    'UnpaidVacation' => 'Unpaid Vacation'
                )
            )
        ));
        
        $this->setWidget('date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('report_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('report_Received_On', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
    }

}
