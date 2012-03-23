<?php

class WorkingHourForm_User extends WorkingHourForm
{
  public function configure()
  {
    unset($this['user_id']);
    unset($this['date']);
    unset($this['time']);
    
    # new sfWidgetFormInputHidden(),
    $this->setWidget('start', new sfWidgetFormInputText());
    $this->setWidget('end', new sfWidgetFormInputText());
    
    # Making fields required
    $this->setWidget('project_id', new sfWidgetFormDoctrineChoice(
      array('model' => $this->getRelatedModelName('Project'), 'add_empty' => false)));
    $this->setWidget('worktype_id', new sfWidgetFormDoctrineChoice(
      array('model' => $this->getRelatedModelName('WorkType'), 'add_empty' => false)));
    $this->setValidator('project_id', new sfValidatorDoctrineChoice(
      array('model' => $this->getRelatedModelName('Project'), 'required' => true)));
    $this->setValidator('worktype_id', new sfValidatorDoctrineChoice(
      array('model' => $this->getRelatedModelName('WorkType'), 'required' => false)));
    $this->setValidator('start', new sfValidatorTime(array('required' => true)));
    $this->setValidator('end', new sfValidatorTime(array('required' => true)));
      
  }
  
}
