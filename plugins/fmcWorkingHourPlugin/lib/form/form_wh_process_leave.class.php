<?php

class form_wh_process_leave extends PluginWorkingHourLeaveForm {
    
    public function configure() {
        
        unset($this['status']);
        unset($this['from_Date']);
        unset($this['to_Date']);
        unset($this['user_id']);
        unset($this['type']);
        
        $this->widgetSchema->setLabel('description', "Comment / Report Number");
        
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
