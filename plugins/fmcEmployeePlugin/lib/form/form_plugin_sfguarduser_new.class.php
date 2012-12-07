<?php

class form_plugin_sfguarduser_new extends sfGuardUserForm
{
    
    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        
        $this->validatorSchema['password']->setOption('required', true);
        
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
    }
    
}
