<?php

class form_plugin_sfguarduser extends sfGuardUserForm
{
    
    public function configure()
    {   
        unset(
            $this['algorithm'],
            $this['salt'],
            $this['is_super_admin'],   
            $this['last_login'],
            $this['groups_list']
        );
        
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password']->setOption('required', false);
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
        
        $this->widgetSchema->moveField('password_again', 'after', 'password');
        $this->mergePostValidator(new sfValidatorSchemaCompare(
            'password', 
            sfValidatorSchemaCompare::EQUAL, 
            'password_again', 
            array(), 
            array('invalid' => 'The two passwords must be the same.'))
        );
        
        
        /* Refs #51 */
        
        $this->setWidget('group_id', new sfWidgetFormDoctrineChoice(array(
            #'multiple' => false,
            'model' => 'sfGuardGroup',
            'add_empty' => false
        )));
        $this->validatorSchema['group_id']->setOption('required', true);
        
        /* End of Refs #51 */
        
        
        $this->setWidget('permissions_list', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Permissions'),
            'table_method' => 'getOrdered',
            'add_empty' => false)
        ));
        
        $this->widgetSchema['permissions_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['permissions_list']->getChoices()
        ));
        
        
        $this->widgetSchema['work_types_list'] = new sfWidgetFormSelectDoubleList(array(
            'choices' => $this->widgetSchema['work_types_list']->getChoices()
        ));
        
        $this->widgetSchema['group_id']->setLabel('Department');
        
    }
    
}
