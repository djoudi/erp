<?php

class form_costFormUser_newItem extends CostFormItemForm
{
  public function configure()
  {
    # disabling process status
    unset($this['is_Processed']);
  
    # hiding cost form id
    $this->setWidget('costForm_id', new sfWidgetFormInputHidden(array(),array()));
    
    # setting date
    $this->setWidget('cost_Date', new sfWidgetFormJQueryDate(
      array(
        'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
        'image' => '/images/calendar.png',
        'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
      )
    ));
    
    
    # setting VAT
    $this->setWidget('vat_id', new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Vats'),
      'table_method' => 'getActive',
      'add_empty' => false)
    ));
    
    $vatDefault = Doctrine::getTable('Vat')->findOneByisDefault(true)->id;
    $this->setDefault('vat_id', $vatDefault);
    
    
    # setting Currency
    $this->setWidget('currency_id', new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Currencies'),
      'table_method' => 'getActive',
      'add_empty' => false)
    ));
    $curDefault = Doctrine::getTable('Currency')->findOneByisDefault(true)->id;
    $this->setDefault('currency_id', $curDefault);
    
    # setting others
    unset($this['isPaid']);
    $this->widgetSchema->setLabel('dontInvoice', "Don't Invoice");
    
  }
}
