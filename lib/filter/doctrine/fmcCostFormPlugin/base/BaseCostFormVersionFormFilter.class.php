<?php

/**
 * CostFormVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCostFormVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee_id'     => new sfWidgetFormFilterInput(),
      'project_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'advanceReceived' => new sfWidgetFormFilterInput(),
      'currency_id'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'isSent'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'creater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'employee_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'project_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'advanceReceived' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currency_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isSent'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'creater_id'      => new sfValidatorPass(array('required' => false)),
      'updater_id'      => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cost_form_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormVersion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'employee_id'     => 'Number',
      'project_id'      => 'Number',
      'advanceReceived' => 'Number',
      'currency_id'     => 'Number',
      'isSent'          => 'Boolean',
      'creater_id'      => 'Text',
      'updater_id'      => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'deleted_at'      => 'Date',
      'version'         => 'Number',
    );
  }
}
