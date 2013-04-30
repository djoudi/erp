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
        
        $years = range(1990, round(date("Y")));
        $years_list = array_combine($years, $years);
        
        $this->setWidget('employment_start', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%year%%month%%day%', 'years'=>$years_list)),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        $this->setWidget('v', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%year%%month%%day%', 'years'=>$years_list)),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
    }
    
}
