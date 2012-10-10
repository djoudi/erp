<?php

class WorkingHourForm_leaverequest extends WorkingHourLeaveForm {
    
    public function configure() {
    
        unset($this['user_id']);
        unset($this['type']);;
        unset($this['status']);
        unset($this['status_user']);

        $this->widgetSchema->setLabel('description', "Comment (optional)");
        
        $this->setWidget('from_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('to_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
    }

}
