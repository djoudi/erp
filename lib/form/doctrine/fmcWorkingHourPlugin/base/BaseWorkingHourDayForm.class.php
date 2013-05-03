<?php

/**
 * WorkingHourDay form base class.
 *
 * @method WorkingHourDay getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourDayForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'employee_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => false)),
      'date'         => new sfWidgetFormDate(),
      'status'       => new sfWidgetFormChoice(array('choices' => array('Draft' => 'Draft', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'leave_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveRequest'), 'add_empty' => true)),
      'multiplier'   => new sfWidgetFormInputText(),
      'daily_Breaks' => new sfWidgetFormInputText(),
      'balance'      => new sfWidgetFormInputText(),
      'creater_id'   => new sfWidgetFormInputText(),
      'updater_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'employee_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'))),
      'date'         => new sfValidatorDate(),
      'status'       => new sfValidatorChoice(array('choices' => array(0 => 'Draft', 1 => 'Accepted', 2 => 'Denied'), 'required' => false)),
      'leave_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveRequest'), 'required' => false)),
      'multiplier'   => new sfValidatorNumber(array('required' => false)),
      'daily_Breaks' => new sfValidatorInteger(array('required' => false)),
      'balance'      => new sfValidatorInteger(array('required' => false)),
      'creater_id'   => new sfValidatorPass(),
      'updater_id'   => new sfValidatorPass(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'version'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_day[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourDay';
  }

}
