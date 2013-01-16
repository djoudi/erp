<?php

class filter_costFormItem_process extends CostFormItemFormFilter
{
    
    public function configure()
    {
    	parent::configure();
    	
        $this->useFields(array(
            'description', 
            'amount', 
            'invoice_To', 
        ));
        
        $this->setWidget('employee_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('CostForms'),
            'table_method' => 'ReportListEmployees', 
            'add_empty' => true
        )));
        
        $this->setValidator('employee_id', new sfValidatorPass(array('required' => false)));
        
    }
    
    public function addemployeeidColumnQuery(Doctrine_Query $query, $field, $value)
    {
        if ($value)
        {
            $query->andWhere('cf.employee_id = ?', $value);
        }
    }
}
