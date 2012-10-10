<?php

/**
 * WorkingHourLeaveVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourLeaveVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'IllnessWReport' => 'IllnessWReport', 'IllnessWoReport' => 'IllnessWoReport', 'PaidVacation' => 'PaidVacation', 'UnpaidVacation' => 'UnpaidVacation'))),
      'from_Date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'to_Date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'status'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Pending' => 'Pending', 'Approved' => 'Approved', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
      'report_Date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'report_Received'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'report_Received_On' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'creater_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'               => new sfValidatorChoice(array('required' => false, 'choices' => array('IllnessWReport' => 'IllnessWReport', 'IllnessWoReport' => 'IllnessWoReport', 'PaidVacation' => 'PaidVacation', 'UnpaidVacation' => 'UnpaidVacation'))),
      'from_Date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'to_Date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'description'        => new sfValidatorPass(array('required' => false)),
      'status'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Pending' => 'Pending', 'Approved' => 'Approved', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
      'report_Date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'report_Received'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'report_Received_On' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'creater_id'         => new sfValidatorPass(array('required' => false)),
      'updater_id'         => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_leave_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourLeaveVersion';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'Number',
      'type'               => 'Enum',
      'from_Date'          => 'Date',
      'to_Date'            => 'Date',
      'description'        => 'Text',
      'status'             => 'Enum',
      'report_Date'        => 'Date',
      'report_Received'    => 'Boolean',
      'report_Received_On' => 'Date',
      'creater_id'         => 'Text',
      'updater_id'         => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'deleted_at'         => 'Date',
      'version'            => 'Number',
    );
  }
}
