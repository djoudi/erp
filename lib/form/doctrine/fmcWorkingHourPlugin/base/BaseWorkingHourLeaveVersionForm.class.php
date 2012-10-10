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
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormInputText(),
      'type'               => new sfWidgetFormChoice(array('choices' => array('IllnessWReport' => 'IllnessWReport', 'IllnessWoReport' => 'IllnessWoReport', 'PaidVacation' => 'PaidVacation', 'UnpaidVacation' => 'UnpaidVacation'))),
      'from_Date'          => new sfWidgetFormDate(),
      'to_Date'            => new sfWidgetFormDate(),
      'description'        => new sfWidgetFormInputText(),
      'status'             => new sfWidgetFormChoice(array('choices' => array('Pending' => 'Pending', 'Approved' => 'Approved', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
      'report_Date'        => new sfWidgetFormDate(),
      'report_Received'    => new sfWidgetFormInputCheckbox(),
      'report_Received_On' => new sfWidgetFormDate(),
      'creater_id'         => new sfWidgetFormInputText(),
      'updater_id'         => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'deleted_at'         => new sfWidgetFormDateTime(),
      'version'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorInteger(),
      'type'               => new sfValidatorChoice(array('choices' => array(0 => 'IllnessWReport', 1 => 'IllnessWoReport', 2 => 'PaidVacation', 3 => 'UnpaidVacation'))),
      'from_Date'          => new sfValidatorDate(),
      'to_Date'            => new sfValidatorDate(),
      'description'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'status'             => new sfValidatorChoice(array('choices' => array(0 => 'Pending', 1 => 'Approved', 2 => 'Denied', 3 => 'Cancelled'))),
      'report_Date'        => new sfValidatorDate(array('required' => false)),
      'report_Received'    => new sfValidatorBoolean(array('required' => false)),
      'report_Received_On' => new sfValidatorDate(array('required' => false)),
      'creater_id'         => new sfValidatorPass(),
      'updater_id'         => new sfValidatorPass(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'deleted_at'         => new sfValidatorDateTime(array('required' => false)),
      'version'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
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
