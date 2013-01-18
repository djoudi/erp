<?php

/**
 * CostFormInvoicingItemVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCostFormInvoicingItemVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'invoicing_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cost_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'creater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'invoicing_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cost_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'creater_id'   => new sfValidatorPass(array('required' => false)),
      'updater_id'   => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cost_form_invoicing_item_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormInvoicingItemVersion';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'invoicing_id' => 'Number',
      'cost_id'      => 'Number',
      'creater_id'   => 'Text',
      'updater_id'   => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'deleted_at'   => 'Date',
      'version'      => 'Number',
    );
  }
}
