<?php

/**
 * LeaveRequestVersion form base class.
 *
 * @method LeaveRequestVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormInputText(),
      'type_id'         => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormChoice(array('choices' => array('Draft' => 'Draft', 'Pending' => 'Pending', 'Accepted' => 'Accepted', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
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
      'version'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'         => new sfValidatorInteger(),
      'type_id'         => new sfValidatorInteger(),
      'status'          => new sfValidatorChoice(array('choices' => array(0 => 'Draft', 1 => 'Pending', 2 => 'Accepted', 3 => 'Denied', 4 => 'Cancelled'), 'required' => false)),
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
      'version'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_request_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequestVersion';
  }

}
