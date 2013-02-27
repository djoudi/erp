<?php

class whForm_dailyBreaks extends BaseForm
{
    
    public function setup()
    {
        parent::setup();
        
        $this->setWidgets(array(
            'total_Daily_Breaks'   => new sfWidgetFormInputText(),
        ));
        
        $this->setValidators(array(
            'total_Daily_Breaks'     => new sfValidatorInteger(array('required' => false)),
        ));
        
        $this->widgetSchema->setNameFormat('wh_form_dailybreaks[%s]');
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        
        parent::setup();
    }
    
}
