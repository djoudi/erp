<?php

class Form_Holiday extends HolidayForm
{
    
    public function configure()
    {
        $this->setWidget('day', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%year%%month%%day%')),
            'image' => '/images/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
    }
    
}