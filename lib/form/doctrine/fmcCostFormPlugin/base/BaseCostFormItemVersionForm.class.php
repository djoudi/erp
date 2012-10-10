<?php

/**
 * CostFormItemVersion form base class.
 *
 * @method CostFormItemVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCostFormItemVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'costForm_id'  => new sfWidgetFormInputText(),
      'cost_Date'    => new sfWidgetFormDate(),
      'description'  => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
      'currency_id'  => new sfWidgetFormInputText(),
      'receipt_No'   => new sfWidgetFormInputText(),
      'invoice_To'   => new sfWidgetFormChoice(array('choices' => array('FMC' => 'FMC', 'Customer' => 'Customer'))),
      'vat_id'       => new sfWidgetFormInputText(),
      'is_Processed' => new sfWidgetFormInputCheckbox(),
      'invoice_No'   => new sfWidgetFormInputText(),
      'invoice_Date' => new sfWidgetFormDate(),
      'dontInvoice'  => new sfWidgetFormInputCheckbox(),
      'isPaid'       => new sfWidgetFormInputCheckbox(),
      'creater_id'   => new sfWidgetFormInputText(),
      'updater_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'costForm_id'  => new sfValidatorInteger(),
      'cost_Date'    => new sfValidatorDate(),
      'description'  => new sfValidatorString(array('max_length' => 250)),
      'amount'       => new sfValidatorNumber(),
      'currency_id'  => new sfValidatorInteger(),
      'receipt_No'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'invoice_To'   => new sfValidatorChoice(array('choices' => array(0 => 'FMC', 1 => 'Customer'), 'required' => false)),
      'vat_id'       => new sfValidatorInteger(),
      'is_Processed' => new sfValidatorBoolean(array('required' => false)),
      'invoice_No'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'invoice_Date' => new sfValidatorDate(array('required' => false)),
      'dontInvoice'  => new sfValidatorBoolean(array('required' => false)),
      'isPaid'       => new sfValidatorBoolean(array('required' => false)),
      'creater_id'   => new sfValidatorPass(),
      'updater_id'   => new sfValidatorPass(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'version'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cost_form_item_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormItemVersion';
  }

}
