<?php

class form_wh_exitday extends WorkingHourDayForm {
  
    public function configure () {
        
        unset($this['type']);
        unset($this['user_id']);
        unset($this['date']);
        unset($this['created_by']);
        unset($this['updated_by']);
        
        $this->setWidget('time', new sfWidgetFormInputText());
        
        $this->widgetSchema['time']->setLabel('Office exit');
        
        $this->setDefault('time', "18:00"); 
    
    }
  
}
