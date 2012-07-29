<?php

/**
 * WorkingHourLeave filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourLeaveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'type'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'IllnessWReport' => 'IllnessWReport', 'IllnessWoReport' => 'IllnessWoReport', 'PaidVacation' => 'PaidVacation', 'UnpaidVacation' => 'UnpaidVacation'))),
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'status'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Pending' => 'Pending', 'Approved' => 'Approved', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
      'status_user'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('StatusUser'), 'add_empty' => true)),
      'report_Received'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'report_Received_On' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updater'), 'add_empty' => true)),
      'deleted_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'version'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'type'               => new sfValidatorChoice(array('required' => false, 'choices' => array('IllnessWReport' => 'IllnessWReport', 'IllnessWoReport' => 'IllnessWoReport', 'PaidVacation' => 'PaidVacation', 'UnpaidVacation' => 'UnpaidVacation'))),
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'description'        => new sfValidatorPass(array('required' => false)),
      'status'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Pending' => 'Pending', 'Approved' => 'Approved', 'Denied' => 'Denied', 'Cancelled' => 'Cancelled'))),
      'status_user'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('StatusUser'), 'column' => 'id')),
      'report_Received'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'report_Received_On' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Creator'), 'column' => 'id')),
      'updated_by'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Updater'), 'column' => 'id')),
      'deleted_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_leave_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourLeave';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'type'               => 'Enum',
      'date'               => 'Date',
      'description'        => 'Text',
      'status'             => 'Enum',
      'status_user'        => 'ForeignKey',
      'report_Received'    => 'Boolean',
      'report_Received_On' => 'Date',
      'created_by'         => 'ForeignKey',
      'updated_by'         => 'ForeignKey',
      'deleted_at'         => 'Date',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'version'            => 'Number',
    );
  }
}
