<?php

class form_wh_process_leave extends PluginWorkingHourLeaveForm {
    
    public function configure() {
        
        unset($this['status_user']);
        unset($this['status']);
        unset($this['user_id']);
        
        $this->widgetSchema->setLabel('type', "Leave Type");
        $this->widgetSchema->setLabel('description', "Comment / Report Number");
        
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
