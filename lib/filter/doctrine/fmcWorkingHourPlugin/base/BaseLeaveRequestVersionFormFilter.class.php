<?php

/**
 * LeaveRequestVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'Accepted' => 'Accepted', 'Denied' => 'Denied', 'Pending' => 'Pending', 'Cancelled' => 'Cancelled'))),
      'start_Date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_Date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'day_Count'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'report_Comment'  => new sfWidgetFormFilterInput(),
      'report_Date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'report_Received' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'creater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'user_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'          => new sfValidatorChoice(array('required' => false, 'choices' => array('Accepted' => 'Accepted', 'Denied' => 'Denied', 'Pending' => 'Pending', 'Cancelled' => 'Cancelled'))),
      'start_Date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end_Date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'day_Count'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'report_Comment'  => new sfValidatorPass(array('required' => false)),
      'report_Date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'report_Received' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'creater_id'      => new sfValidatorPass(array('required' => false)),
      'updater_id'      => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('leave_request_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequestVersion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'user_id'         => 'Number',
      'type_id'         => 'Number',
      'status'          => 'Enum',
      'start_Date'      => 'Date',
      'end_Date'        => 'Date',
      'day_Count'       => 'Number',
      'report_Comment'  => 'Text',
      'report_Date'     => 'Date',
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
