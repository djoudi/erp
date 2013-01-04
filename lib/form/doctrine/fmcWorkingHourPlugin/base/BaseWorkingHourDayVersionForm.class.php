<?php

/**
 * WorkingHourDayVersion form base class.
 *
 * @method WorkingHourDayVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourDayVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'employee_id' => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('Draft' => 'Draft', 'Pending' => 'Pending', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'leave_id'    => new sfWidgetFormInputText(),
      'multiplier'  => new sfWidgetFormInputText(),
      'creater_id'  => new sfWidgetFormInputText(),
      'updater_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'deleted_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'employee_id' => new sfValidatorInteger(),
      'date'        => new sfValidatorDate(),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'Draft', 1 => 'Pending', 2 => 'Accepted', 3 => 'Denied'), 'required' => false)),
      'leave_id'    => new sfValidatorInteger(array('required' => false)),
      'multiplier'  => new sfValidatorNumber(array('required' => false)),
      'creater_id'  => new sfValidatorPass(),
      'updater_id'  => new sfValidatorPass(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'deleted_at'  => new sfValidatorDateTime(array('required' => false)),
      'version'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_day_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourDayVersion';
  }

}
