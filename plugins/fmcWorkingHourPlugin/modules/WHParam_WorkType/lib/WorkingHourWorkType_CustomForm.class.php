<?php

class WorkingHourWorkType_CustomForm extends WorkingHourWorkTypeForm
{
    public function configure()
    {
        $this->widgetSchema['employees_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['employees_list']->getChoices(), 
            'label_associated' => 'Selected',
            'label_unassociated' => 'Available'
        ));
        
        $this->widgetSchema['departments_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['departments_list']->getChoices(), 
            'label_associated' => 'Selected',
            'label_unassociated' => 'Available'
        ));
    }
    
}
