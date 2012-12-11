<?php

class whFilter_dayRequest extends WorkingHourDayFormFilter
{
    
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['status'],
            $this['leave_id'],
            $this['multiplier']
        );
        
        $this->widgetSchema['user_id']->setLabel('Employee');
        
        $this->setWidget('date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
    }
    
}
