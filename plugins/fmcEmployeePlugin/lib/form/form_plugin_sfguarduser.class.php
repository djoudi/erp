<?php

class form_plugin_sfguarduser extends sfGuardUserForm
{
    
    public function configure()
    {   
    	parent::configure();
        
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
        
        $this->setWidget('employment_start', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%year%%month%%day%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('employment_end', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%year%%month%%day%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
    }
    
}
