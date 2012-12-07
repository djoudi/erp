<?php

class form_costFormUser_newItem extends CostFormItemForm
{
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['is_Processed'],
            $this['isPaid']
        );
        
        
        $this->setWidget('costForm_id', new sfWidgetFormInputHidden(array(),array()));
        // @TODO : can it not be hidden?
        
        
        $this->setWidget('cost_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        
        $this->setWidget('invoice_Date', new sfWidgetFormJQueryDate(array(
            'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
            'image' => '/img/calendar.png',
            'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
        )));
        
        
        $this->setWidget('vat_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Vats'),
            'table_method' => 'getActive',
            'add_empty' => false)
        ));
        
        
        $this->setDefault('vat_id', Doctrine::getTable('Vat')->findOneByisDefault(true)->getId());
        
        
        $this->setWidget('currency_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Currencies'),
            'table_method' => 'getActive',
            'add_empty' => false)
        ));
        
        
        $this->setDefault('currency_id',
            Doctrine::getTable('Currency')->findOneByisDefault(true)->id
        );
        
        
        $this->widgetSchema->setLabel('dontInvoice', "Don't Invoice");
    }
    
}
