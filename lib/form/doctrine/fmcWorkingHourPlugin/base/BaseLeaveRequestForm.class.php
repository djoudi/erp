<?php

/**
 * LeaveRequest form base class.
 *
 * @method LeaveRequest getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => false)),
      'type_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveType'), 'add_empty' => false)),
      'status'          => new sfWidgetFormChoice(array('choices' => array('Accepted' => 'Accepted', 'Denied' => 'Denied', 'Pending' => 'Pending', 'Cancelled' => 'Cancelled'))),
      'start_Date'      => new sfWidgetFormDate(),
      'end_Date'        => new sfWidgetFormDate(),
      'day_Count'       => new sfWidgetFormInputText(),
      'report_Comment'  => new sfWidgetFormInputText(),
      'report_Date'     => new sfWidgetFormDate(),
      'report_Received' => new sfWidgetFormDate(),
      'creater_id'      => new sfWidgetFormInputText(),
      'updater_id'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'version'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'))),
      'type_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveType'))),
      'status'          => new sfValidatorChoice(array('choices' => array(0 => 'Accepted', 1 => 'Denied', 2 => 'Pending', 3 => 'Cancelled'), 'required' => false)),
      'start_Date'      => new sfValidatorDate(),
      'end_Date'        => new sfValidatorDate(),
      'day_Count'       => new sfValidatorInteger(array('required' => false)),
      'report_Comment'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'report_Date'     => new sfValidatorDate(array('required' => false)),
      'report_Received' => new sfValidatorDate(array('required' => false)),
      'creater_id'      => new sfValidatorPass(),
      'updater_id'      => new sfValidatorPass(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'version'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_request[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequest';
  }

}
