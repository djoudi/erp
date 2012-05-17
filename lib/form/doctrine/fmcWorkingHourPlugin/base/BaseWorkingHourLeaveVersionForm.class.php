<?php

/**
 * WorkingHourLeaveVersion form base class.
 *
 * @method WorkingHourLeaveVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourLeaveVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'type'        => new sfWidgetFormChoice(array('choices' => array('RaporluHastalik' => 'RaporluHastalik', 'RaporsuzHastalik' => 'RaporsuzHastalik', 'UcretliIzin' => 'UcretliIzin', 'UcretsizIzin' => 'UcretsizIzin'))),
      'status'      => new sfWidgetFormChoice(array('choices' => array('Draft' => 'Draft', 'Approved' => 'Approved', 'Cancelled' => 'Cancelled'))),
      'status_user' => new sfWidgetFormInputText(),
      'created_by'  => new sfWidgetFormInputText(),
      'updated_by'  => new sfWidgetFormInputText(),
      'deleted_at'  => new sfWidgetFormDateTime(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorInteger(),
      'date'        => new sfValidatorDate(),
      'type'        => new sfValidatorChoice(array('choices' => array(0 => 'RaporluHastalik', 1 => 'RaporsuzHastalik', 2 => 'UcretliIzin', 3 => 'UcretsizIzin'))),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'Draft', 1 => 'Approved', 2 => 'Cancelled'))),
      'status_user' => new sfValidatorInteger(),
      'created_by'  => new sfValidatorInteger(array('required' => false)),
      'updated_by'  => new sfValidatorInteger(array('required' => false)),
      'deleted_at'  => new sfValidatorDateTime(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_leave_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourLeaveVersion';
  }

}
