<?php

/**
 * WorkingHourDayVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourDayVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'status'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Draft' => 'Draft', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'leave_id'     => new sfWidgetFormFilterInput(),
      'multiplier'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'daily_Breaks' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'creater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'employee_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'       => new sfValidatorChoice(array('required' => false, 'choices' => array('Draft' => 'Draft', 'Accepted' => 'Accepted', 'Denied' => 'Denied'))),
      'leave_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'multiplier'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'daily_Breaks' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'balance'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'creater_id'   => new sfValidatorPass(array('required' => false)),
      'updater_id'   => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_day_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourDayVersion';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'employee_id'  => 'Number',
      'date'         => 'Date',
      'status'       => 'Enum',
      'leave_id'     => 'Number',
      'multiplier'   => 'Number',
      'daily_Breaks' => 'Number',
      'balance'      => 'Number',
      'creater_id'   => 'Text',
      'updater_id'   => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'deleted_at'   => 'Date',
      'version'      => 'Number',
    );
  }
}
