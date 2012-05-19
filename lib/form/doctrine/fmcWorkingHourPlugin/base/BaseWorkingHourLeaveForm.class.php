<?php

/**
 * WorkingHourLeave form base class.
 *
 * @method WorkingHourLeave getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourLeaveForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'type'        => new sfWidgetFormChoice(array('choices' => array('RaporluHastalik' => 'RaporluHastalik', 'RaporsuzHastalik' => 'RaporsuzHastalik', 'UcretliIzin' => 'UcretliIzin', 'UcretsizIzin' => 'UcretsizIzin'))),
      'date'        => new sfWidgetFormDate(),
      'report_date' => new sfWidgetFormDate(),
      'description' => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('Draft' => 'Draft', 'Approved' => 'Approved', 'Cancelled' => 'Cancelled'))),
      'status_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('StatusUser'), 'add_empty' => false)),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updater'), 'add_empty' => true)),
      'deleted_at'  => new sfWidgetFormDateTime(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'type'        => new sfValidatorChoice(array('choices' => array(0 => 'RaporluHastalik', 1 => 'RaporsuzHastalik', 2 => 'UcretliIzin', 3 => 'UcretsizIzin'))),
      'date'        => new sfValidatorDate(),
      'report_date' => new sfValidatorDate(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'Draft', 1 => 'Approved', 2 => 'Cancelled'))),
      'status_user' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('StatusUser'))),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updater'), 'required' => false)),
      'deleted_at'  => new sfValidatorDateTime(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_leave[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourLeave';
  }

}
