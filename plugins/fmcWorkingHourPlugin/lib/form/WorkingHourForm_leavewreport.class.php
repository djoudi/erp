<?php

class WorkingHourForm_leavewreport extends WorkingHourLeaveForm
{
  public function configure()
  {
    unset($this['user_id']);
    unset($this['type']);
    unset($this['date']);
    unset($this['status']);
    unset($this['status_user']);
    
    $this->setWidget('report_date', new sfWidgetFormJQueryDate(
      array(
        'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
        'image' => '/images/calendar.png',
        'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
      )
    ));
    
    $this->widgetSchema->setLabel('description', "Report number");
  }
  
}
