<?php

class sfGuardDepartmentForm extends PluginsfGuardGroupForm
{

    public function setupInheritance()
    {
    
        parent::setupInheritance();
        
        unset(
            $this['users_list'],
            $this['permissions_list'],
            $this['description']
        );
        
        $this->widgetSchema['work_types_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['work_types_list']->getChoices()
        ));
        
    }
    
}
