<?php

/**
 * WorkingHourRecord form base class.
 *
 * @method WorkingHourRecord getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourRecordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'day_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Day'), 'add_empty' => false)),
      'recordType'   => new sfWidgetFormChoice(array('choices' => array('Work' => 'Work', 'Entrance' => 'Entrance', 'Exit' => 'Exit'))),
      'start_Time'   => new sfWidgetFormTime(),
      'end_Time'     => new sfWidgetFormTime(),
      'project_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => true)),
      'work_Type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WorkType'), 'add_empty' => true)),
      'comment'      => new sfWidgetFormInputText(),
      'creater_id'   => new sfWidgetFormInputText(),
      'updater_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'day_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Day'))),
      'recordType'   => new sfValidatorChoice(array('choices' => array(0 => 'Work', 1 => 'Entrance', 2 => 'Exit'), 'required' => false)),
      'start_Time'   => new sfValidatorTime(),
      'end_Time'     => new sfValidatorTime(array('required' => false)),
      'project_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'required' => false)),
      'work_Type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WorkType'), 'required' => false)),
      'comment'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'creater_id'   => new sfValidatorPass(),
      'updater_id'   => new sfValidatorPass(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'version'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_record[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourRecord';
  }

}
