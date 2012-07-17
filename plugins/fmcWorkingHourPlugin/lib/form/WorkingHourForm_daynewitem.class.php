<?php

class WorkingHourForm_dayitemnew extends WorkingHourForm {
    
    public function configure() {
        
        unset($this['user_id']);
        unset($this['date']);
        unset($this['time']);
    
        $this->setWidget('start', new sfWidgetFormInputText());
        
        $this->setWidget('end', new sfWidgetFormInputText());
        
        $this->setWidget('worktype_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('WorkType'),
            'table_method' => 'getOrderedUserRights',
            'add_empty' => false)
        ));
        
    }
    
}
