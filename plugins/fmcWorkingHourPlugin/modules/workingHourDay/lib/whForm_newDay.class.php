<?php

class whForm_newDay extends BaseForm
{
    
    public function setup()
    {
        parent::configure();
        
        $this->setWidgets(array(
            'entrance'   => new sfWidgetFormInputText(),
            'exit'     => new sfWidgetFormInputText(),
        ));
        
        $this->setValidators(array(
            'entrance'   => new sfValidatorTime(),
            'exit'     => new sfValidatorTime(array('required' => false)),
        ));
        
        $this->widgetSchema->setNameFormat('wh_form_newday[%s]');
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        
        parent::setup();
    }
    
}
