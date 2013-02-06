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
        
        // Office Entrance and Exit
        
            $this->widgetSchema['office_Entrance'] = new sfWidgetFormInputText();
            
            $this->widgetSchema['office_Exit'] = new sfWidgetFormInputText();
        
        
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
        
        // Putting in order
            
            $this->widgetSchema->moveField ('is_active', sfWidgetFormSchema::BEFORE, 'first_name');
            
            $this->widgetSchema->moveField ('send_Email', sfWidgetFormSchema::AFTER, 'email_address');
            
            $this->widgetSchema->moveField ('default_Work_Type_id', sfWidgetFormSchema::BEFORE, 'work_types_list');

    }
    
}
