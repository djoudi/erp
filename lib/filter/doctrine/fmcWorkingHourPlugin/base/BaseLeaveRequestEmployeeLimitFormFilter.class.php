<?php

/**
 * LeaveRequestEmployeeLimit filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLeaveRequestEmployeeLimitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true)),
      'type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LeaveType'), 'add_empty' => true)),
      'leave_Limit' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'added_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adder'), 'add_empty' => true)),
      'comment'     => new sfWidgetFormFilterInput(),
      'creater_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'version'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'employee_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Employee'), 'column' => 'id')),
      'type_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LeaveType'), 'column' => 'id')),
      'leave_Limit' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adder'), 'column' => 'id')),
      'comment'     => new sfValidatorPass(array('required' => false)),
      'creater_id'  => new sfValidatorPass(array('required' => false)),
      'updater_id'  => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('leave_request_employee_limit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveRequestEmployeeLimit';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'employee_id' => 'ForeignKey',
      'type_id'     => 'ForeignKey',
      'leave_Limit' => 'Number',
      'added_by'    => 'ForeignKey',
      'comment'     => 'Text',
      'creater_id'  => 'Text',
      'updater_id'  => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'version'     => 'Number',
    );
  }
}
