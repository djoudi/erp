<?php

/**
 * LeaveType form base class.
 *
 * @method LeaveType getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLeaveTypeForm extends BaseFormDoctrine
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
      'version'       => new sfWidgetFormInputText(),
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
      'version'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'LeaveType', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('leave_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveType';
  }

}
