<?php

class Form_WorkType extends WorkingHourWorkTypeForm
{
    
    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema['employees_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['employees_list']->getChoices()
        ));
        
        $this->widgetSchema['departments_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['departments_list']->getChoices()
        ));
    }
    
}
