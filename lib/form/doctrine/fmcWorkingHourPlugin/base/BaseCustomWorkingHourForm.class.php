<?php

/**
 * CustomWorkingHour form base class.
 *
 * @method CustomWorkingHour getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomWorkingHourForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'employee_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => false)),
      'date'        => new sfWidgetFormDate(),
      'minutes'     => new sfWidgetFormInputText(),
      'comment'     => new sfWidgetFormInputText(),
      'added_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adder'), 'add_empty' => false)),
      'creater_id'  => new sfWidgetFormInputText(),
      'updater_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'deleted_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'employee_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'))),
      'date'        => new sfValidatorDate(),
      'minutes'     => new sfValidatorInteger(array('required' => false)),
      'comment'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'added_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adder'))),
      'creater_id'  => new sfValidatorPass(),
      'updater_id'  => new sfValidatorPass(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'deleted_at'  => new sfValidatorDateTime(array('required' => false)),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('custom_working_hour[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomWorkingHour';
  }

}
