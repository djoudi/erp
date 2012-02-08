<?php

/**
 * CostFormItem filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCostFormItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'costForm_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CostForms'), 'add_empty' => true)),
      'cost_Date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currency_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currencies'), 'add_empty' => true)),
      'receipt_No'   => new sfWidgetFormFilterInput(),
      'invoice_To'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'FMC' => 'FMC', 'Customer' => 'Customer'))),
      'vat_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vats'), 'add_empty' => true)),
      'is_Processed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'invoice_No'   => new sfWidgetFormFilterInput(),
      'dontInvoice'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'isPaid'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'deleted_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'costForm_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CostForms'), 'column' => 'id')),
      'cost_Date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'description'  => new sfValidatorPass(array('required' => false)),
      'amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currency_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Currencies'), 'column' => 'id')),
      'receipt_No'   => new sfValidatorPass(array('required' => false)),
      'invoice_To'   => new sfValidatorChoice(array('required' => false, 'choices' => array('FMC' => 'FMC', 'Customer' => 'Customer'))),
      'vat_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vats'), 'column' => 'id')),
      'is_Processed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'invoice_No'   => new sfValidatorPass(array('required' => false)),
      'dontInvoice'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'isPaid'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'deleted_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cost_form_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormItem';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'costForm_id'  => 'ForeignKey',
      'cost_Date'    => 'Date',
      'description'  => 'Text',
      'amount'       => 'Number',
      'currency_id'  => 'ForeignKey',
      'receipt_No'   => 'Text',
      'invoice_To'   => 'Enum',
      'vat_id'       => 'ForeignKey',
      'is_Processed' => 'Boolean',
      'invoice_No'   => 'Text',
      'dontInvoice'  => 'Boolean',
      'isPaid'       => 'Boolean',
      'deleted_at'   => 'Date',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
