<?php

/**
 * WorkingHourRecordVersion form base class.
 *
 * @method WorkingHourRecordVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourRecordVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'day_id'       => new sfWidgetFormInputText(),
      'recordType'   => new sfWidgetFormChoice(array('choices' => array('Work' => 'Work', 'Entrance' => 'Entrance', 'Exit' => 'Exit'))),
      'start_Time'   => new sfWidgetFormTime(),
      'end_Time'     => new sfWidgetFormTime(),
      'project_id'   => new sfWidgetFormInputText(),
      'work_Type_id' => new sfWidgetFormInputText(),
      'comment'      => new sfWidgetFormInputText(),
      'creater_id'   => new sfWidgetFormInputText(),
      'updater_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'day_id'       => new sfValidatorInteger(),
      'recordType'   => new sfValidatorChoice(array('choices' => array(0 => 'Work', 1 => 'Entrance', 2 => 'Exit'), 'required' => false)),
      'start_Time'   => new sfValidatorTime(),
      'end_Time'     => new sfValidatorTime(array('required' => false)),
      'project_id'   => new sfValidatorInteger(array('required' => false)),
      'work_Type_id' => new sfValidatorInteger(array('required' => false)),
      'comment'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'creater_id'   => new sfValidatorPass(),
      'updater_id'   => new sfValidatorPass(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'version'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_record_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourRecordVersion';
  }

}
