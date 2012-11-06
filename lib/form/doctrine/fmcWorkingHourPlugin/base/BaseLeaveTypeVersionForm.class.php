<?php

/**
 * LeaveTypeVersion form base class.
 *
 * @method LeaveTypeVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLeaveTypeVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'default_Limit' => new sfWidgetFormInputText(),
      'has_Report'    => new sfWidgetFormInputCheckbox(),
      'creater_id'    => new sfWidgetFormInputText(),
      'updater_id'    => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'deleted_at'    => new sfWidgetFormDateTime(),
      'version'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 50)),
      'default_Limit' => new sfValidatorInteger(array('required' => false)),
      'has_Report'    => new sfValidatorBoolean(array('required' => false)),
      'creater_id'    => new sfValidatorPass(),
      'updater_id'    => new sfValidatorPass(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'deleted_at'    => new sfValidatorDateTime(array('required' => false)),
      'version'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_type_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveTypeVersion';
  }

}
