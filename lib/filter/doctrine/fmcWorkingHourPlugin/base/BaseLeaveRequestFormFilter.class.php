<?php

/**
 * LeaveRequest filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true)),
      'type_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveType'), 'add_empty' => true)),
      'status'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'Draft' => 'Draft', 'Pending' => 'Pending', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'start_Date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_Date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_half_day'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'day_Count'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'         => new sfWidgetFormFilterInput(),
      'report_Date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'report_Number'   => new sfWidgetFormFilterInput(),
      'report_Received' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'creater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'version'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'employee_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Employee'), 'column' => 'id')),
      'type_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LeaveType'), 'column' => 'id')),
      'status'          => new sfValidatorChoice(array('required' => false, 'choices' => array('Draft' => 'Draft', 'Pending' => 'Pending', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'start_Date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end_Date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_half_day'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'day_Count'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comment'         => new sfValidatorPass(array('required' => false)),
      'report_Date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'report_Number'   => new sfValidatorPass(array('required' => false)),
      'report_Received' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'creater_id'      => new sfValidatorPass(array('required' => false)),
      'updater_id'      => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('leave_request_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequest';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'employee_id'     => 'ForeignKey',
      'type_id'         => 'ForeignKey',
      'status'          => 'Enum',
      'start_Date'      => 'Date',
      'end_Date'        => 'Date',
      'is_half_day'     => 'Boolean',
      'day_Count'       => 'Number',
      'comment'         => 'Text',
      'report_Date'     => 'Date',
      'report_Number'   => 'Text',
      'report_Received' => 'Date',
      'creater_id'      => 'Text',
      'updater_id'      => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'deleted_at'      => 'Date',
      'version'         => 'Number',
    );
  }
}
