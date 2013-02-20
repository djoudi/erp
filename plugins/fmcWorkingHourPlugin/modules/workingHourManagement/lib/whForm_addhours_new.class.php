<?php

class whForm_addhours_new extends CustomWorkingHourForm
{
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['added_by']
        );
        
        $this->setWidget('date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
    }
}
