<?php

abstract class PluginWorkingHourRecordForm extends BaseWorkingHourRecordForm
{
    
    public function setup()
    {
        parent::setup();
        
        unset(
            $this['day_id'],
            $this['recordType']
        );
        
        $this->widgetSchema['start_Time'] = new sfWidgetFormInputText();
        
        $this->widgetSchema['end_Time'] = new sfWidgetFormInputText();
        
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
        
        // Setting default worktype
        
            $user = sfContext::getInstance()->getUser()->getGuardUser();
            
            $userDefault = $user->getDefaultWorkTypeId();
            $departmentDefault = $user->getDepartment()->getDefault_Work_Type()->getId();
            
            $defaultWorkType = $userDefault ? $userDefault : $departmentDefault;
            
            $this->setDefault('work_Type_id', $defaultWorkType);
    }
    
}
