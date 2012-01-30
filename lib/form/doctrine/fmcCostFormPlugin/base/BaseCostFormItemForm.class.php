<?php

/**
 * CostFormItem form base class.
 *
 * @method CostFormItem getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCostFormItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'costForm_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CostForms'), 'add_empty' => false)),
      'cost_Date'    => new sfWidgetFormDate(),
      'description'  => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
      'currency_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currencies'), 'add_empty' => false)),
      'receipt_No'   => new sfWidgetFormInputText(),
      'invoice_To'   => new sfWidgetFormChoice(array('choices' => array('FMC' => 'FMC', 'Customer' => 'Customer'))),
      'vat_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vats'), 'add_empty' => false)),
      'is_Processed' => new sfWidgetFormInputCheckbox(),
      'invoice_No'   => new sfWidgetFormInputText(),
      'dontInvoice'  => new sfWidgetFormInputCheckbox(),
      'isPaid'       => new sfWidgetFormInputCheckbox(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'costForm_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CostForms'))),
      'cost_Date'    => new sfValidatorDate(),
      'description'  => new sfValidatorString(array('max_length' => 250)),
      'amount'       => new sfValidatorInteger(),
      'currency_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Currencies'))),
      'receipt_No'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'invoice_To'   => new sfValidatorChoice(array('choices' => array(0 => 'FMC', 1 => 'Customer'), 'required' => false)),
      'vat_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vats'))),
      'is_Processed' => new sfValidatorBoolean(array('required' => false)),
      'invoice_No'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'dontInvoice'  => new sfValidatorBoolean(array('required' => false)),
      'isPaid'       => new sfValidatorBoolean(array('required' => false)),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cost_form_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormItem';
  }

}
