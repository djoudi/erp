<?php

/**
 * BaseCostFormItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $costForm_id
 * @property date $cost_Date
 * @property string $description
 * @property decimal $amount
 * @property integer $currency_id
 * @property string $receipt_No
 * @property enum $invoice_To
 * @property integer $vat_id
 * @property boolean $is_Processed
 * @property string $invoice_No
 * @property boolean $dontInvoice
 * @property boolean $isPaid
 * @property CostForm $CostForms
 * @property Vat $Vats
 * @property Currency $Currencies
 * 
 * @method integer      getCostFormId()   Returns the current record's "costForm_id" value
 * @method date         getCostDate()     Returns the current record's "cost_Date" value
 * @method string       getDescription()  Returns the current record's "description" value
 * @method decimal      getAmount()       Returns the current record's "amount" value
 * @method integer      getCurrencyId()   Returns the current record's "currency_id" value
 * @method string       getReceiptNo()    Returns the current record's "receipt_No" value
 * @method enum         getInvoiceTo()    Returns the current record's "invoice_To" value
 * @method integer      getVatId()        Returns the current record's "vat_id" value
 * @method boolean      getIsProcessed()  Returns the current record's "is_Processed" value
 * @method string       getInvoiceNo()    Returns the current record's "invoice_No" value
 * @method boolean      getDontInvoice()  Returns the current record's "dontInvoice" value
 * @method boolean      getIsPaid()       Returns the current record's "isPaid" value
 * @method CostForm     getCostForms()    Returns the current record's "CostForms" value
 * @method Vat          getVats()         Returns the current record's "Vats" value
 * @method Currency     getCurrencies()   Returns the current record's "Currencies" value
 * @method CostFormItem setCostFormId()   Sets the current record's "costForm_id" value
 * @method CostFormItem setCostDate()     Sets the current record's "cost_Date" value
 * @method CostFormItem setDescription()  Sets the current record's "description" value
 * @method CostFormItem setAmount()       Sets the current record's "amount" value
 * @method CostFormItem setCurrencyId()   Sets the current record's "currency_id" value
 * @method CostFormItem setReceiptNo()    Sets the current record's "receipt_No" value
 * @method CostFormItem setInvoiceTo()    Sets the current record's "invoice_To" value
 * @method CostFormItem setVatId()        Sets the current record's "vat_id" value
 * @method CostFormItem setIsProcessed()  Sets the current record's "is_Processed" value
 * @method CostFormItem setInvoiceNo()    Sets the current record's "invoice_No" value
 * @method CostFormItem setDontInvoice()  Sets the current record's "dontInvoice" value
 * @method CostFormItem setIsPaid()       Sets the current record's "isPaid" value
 * @method CostFormItem setCostForms()    Sets the current record's "CostForms" value
 * @method CostFormItem setVats()         Sets the current record's "Vats" value
 * @method CostFormItem setCurrencies()   Sets the current record's "Currencies" value
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCostFormItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cost_form_item');
        $this->hasColumn('costForm_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('cost_Date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('description', 'string', 250, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 250,
             ));
        $this->hasColumn('amount', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('currency_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('receipt_No', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('invoice_To', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'FMC',
              1 => 'Customer',
             ),
             'default' => 'Customer',
             'notnull' => true,
             ));
        $this->hasColumn('vat_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('is_Processed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             'notnull' => true,
             ));
        $this->hasColumn('invoice_No', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('dontInvoice', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('isPaid', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CostForm as CostForms', array(
             'local' => 'costForm_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Vat as Vats', array(
             'local' => 'vat_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Currency as Currencies', array(
             'local' => 'currency_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($softdelete0);
        $this->actAs($timestampable0);
        $this->actAs($versionable0);
    }
}