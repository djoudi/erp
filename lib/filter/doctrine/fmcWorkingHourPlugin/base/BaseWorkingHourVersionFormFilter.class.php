<?php

/**
 * WorkingHourVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormFilterInput(),
      'date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'project_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'worktype'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'       => new sfWidgetFormFilterInput(),
      'time_started'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time_finished' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time'          => new sfWidgetFormFilterInput(),
      'created_by'    => new sfWidgetFormFilterInput(),
      'updated_by'    => new sfWidgetFormFilterInput(),
      'deleted_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'project_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'worktype'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment'       => new sfValidatorPass(array('required' => false)),
      'time_started'  => new sfValidatorPass(array('required' => false)),
      'time_finished' => new sfValidatorPass(array('required' => false)),
      'time'          => new sfValidatorPass(array('required' => false)),
      'created_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourVersion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'user_id'       => 'Number',
      'date'          => 'Date',
      'project_id'    => 'Number',
      'worktype'      => 'Number',
      'comment'       => 'Text',
      'time_started'  => 'Text',
      'time_finished' => 'Text',
      'time'          => 'Text',
      'created_by'    => 'Number',
      'updated_by'    => 'Number',
      'deleted_at'    => 'Date',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'version'       => 'Number',
    );
  }
}