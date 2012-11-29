<?php

class whForm_workRecord extends WorkingHourRecordForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset($this['day_id']);
        
        unset($this['recordType']);
        
        $this->widgetSchema['start_Time'] = new sfWidgetFormInputText();
        
        $this->widgetSchema ['end_Time'] = new sfWidgetFormInputText();
        $this->validatorSchema ['end_Time'] = new sfValidatorTime(array('required' => true));
        
        
        $this->widgetSchema['project_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Project'), 
            'table_method' => 'getActive', 
            'add_empty' => false
        ));
        $this->validatorSchema['project_id'] = new sfValidatorDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Project'), 
            'required' => true
        ));
        
        $this->widgetSchema['work_Type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('WorkType'), 
            'table_method' => 'getUserList', 
            'add_empty' => false
        ));
        $this->validatorSchema['work_Type_id'] = new sfValidatorDoctrineChoice(array(
            'model' => $this->getRelatedModelName('WorkType'),
            'required' => true
        ));
    }
    
}
