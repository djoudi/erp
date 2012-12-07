<?php

class sfGuardUserForm extends PluginsfGuardUserForm
{
    
    public function configure()
    {        
        parent::configure();
        
        unset(
            $this['algorithm'],
            $this['salt'],
            $this['is_super_admin'],   
            $this['last_login'],
            $this['groups_list']
        );
        
        
        // Department - Refs #51
        
            $this->setWidget('group_id', new sfWidgetFormDoctrineChoice(array(
                'model' => 'sfGuardGroup',
                'add_empty' => false
            )));
            
            $this->validatorSchema['group_id']->setOption('required', true);
            
            $this->widgetSchema['group_id']->setLabel('Department');
        
        
        // Permissions
        
            $this->widgetSchema['permissions_list'] = new sfWidgetFormSelectDoubleList(array(
                'choices' => $this->widgetSchema['permissions_list']->getChoices()
            ));
            
            $this->widgetSchema['permissions_list']->setLabel('Permissions');
        
        
        // Work Types
        
            $this->widgetSchema['work_types_list'] = new sfWidgetFormSelectDoubleList(array(
                'choices' => $this->widgetSchema['work_types_list']->getChoices()
            ));
            
            $this->widgetSchema['work_types_list']->setLabel('Work Types');
    }
    
}
