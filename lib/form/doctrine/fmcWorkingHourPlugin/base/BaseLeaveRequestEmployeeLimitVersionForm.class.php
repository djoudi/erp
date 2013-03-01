<?php

/**
 * LeaveRequestEmployeeLimitVersion form base class.
 *
 * @method LeaveRequestEmployeeLimitVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestEmployeeLimitVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'employee_id' => new sfWidgetFormInputText(),
      'type_id'     => new sfWidgetFormInputText(),
      'leave_Limit' => new sfWidgetFormInputText(),
      'added_by'    => new sfWidgetFormInputText(),
      'comment'     => new sfWidgetFormInputText(),
      'creater_id'  => new sfWidgetFormInputText(),
      'updater_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'employee_id' => new sfValidatorInteger(),
      'type_id'     => new sfValidatorInteger(),
      'leave_Limit' => new sfValidatorNumber(),
      'added_by'    => new sfValidatorInteger(),
      'comment'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'creater_id'  => new sfValidatorPass(),
      'updater_id'  => new sfValidatorPass(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_request_employee_limit_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequestEmployeeLimitVersion';
  }

}
