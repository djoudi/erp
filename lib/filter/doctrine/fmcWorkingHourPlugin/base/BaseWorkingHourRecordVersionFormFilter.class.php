<?php

/**
 * WorkingHourRecordVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourRecordVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'day_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recordType'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Work' => 'Work', 'Entrance' => 'Entrance', 'Exit' => 'Exit'))),
      'start_Time'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_Time'     => new sfWidgetFormFilterInput(),
      'project_id'   => new sfWidgetFormFilterInput(),
      'work_Type_id' => new sfWidgetFormFilterInput(),
      'comment'      => new sfWidgetFormFilterInput(),
      'details'      => new sfWidgetFormFilterInput(),
      'creater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'day_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'recordType'   => new sfValidatorChoice(array('required' => false, 'choices' => array('Work' => 'Work', 'Entrance' => 'Entrance', 'Exit' => 'Exit'))),
      'start_Time'   => new sfValidatorPass(array('required' => false)),
      'end_Time'     => new sfValidatorPass(array('required' => false)),
      'project_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'work_Type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment'      => new sfValidatorPass(array('required' => false)),
      'details'      => new sfValidatorPass(array('required' => false)),
      'creater_id'   => new sfValidatorPass(array('required' => false)),
      'updater_id'   => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_record_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourRecordVersion';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'day_id'       => 'Number',
      'recordType'   => 'Enum',
      'start_Time'   => 'Text',
      'end_Time'     => 'Text',
      'project_id'   => 'Number',
      'work_Type_id' => 'Number',
      'comment'      => 'Text',
      'details'      => 'Text',
      'creater_id'   => 'Text',
      'updater_id'   => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'deleted_at'   => 'Date',
      'version'      => 'Number',
    );
  }
}
