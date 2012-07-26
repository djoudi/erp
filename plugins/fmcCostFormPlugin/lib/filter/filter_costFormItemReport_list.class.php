<?php

class filter_costFormItemReport_list extends PluginCostFormItemFormFilter {
    
    
    public function configure() {
        
        
        $this->setWidget('id', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('id', new sfValidatorPass(array('required' => false)));
        $this->widgetSchema->moveField ('id', sfWidgetFormSchema::BEFORE, 'costForm_id');
        $this->widgetSchema->setLabel('id', 'Cost No');
        
        
        $this->setWidget('costForm_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('costForm_id', new sfValidatorPass(array('required' => false)));
        $this->widgetSchema->setLabel('costForm_id', 'Cost Form No');
        
        
        $this->setWidget('employee_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('CostForms'),
            'table_method' => 'ReportListEmployees', 
            'add_empty' => true
        )));
        $this->setValidator('employee_id', new sfValidatorPass(array('required' => false)));
        $this->widgetSchema->moveField ('employee_id', sfWidgetFormSchema::AFTER, 'costForm_id');
        
        
        $this->setWidget('project_id', new sfWidgetFormDoctrineChoice(array(
        	'model' => $this->getRelatedModelName('CostForms'),
        	'table_method' => 'ReportListProjects', 
        	'add_empty' => true
        )));
        $this->setValidator('project_id', new sfValidatorPass(array('required' => false)));
        $this->widgetSchema->moveField ('project_id', sfWidgetFormSchema::AFTER, 'employee_id');
        
        
        $this->setWidget ('receipt_No', new sfWidgetFormFilterInput(array('with_empty' => false)));
        
        
        $this->setWidget ('is_Processed', new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Invoiced', 0 => 'Not Invoiced'))) );
        $this->widgetSchema->setLabel('is_Processed', 'Invoicing Status');
        
        
        $this->setWidget ('invoice_No', new sfWidgetFormFilterInput(array('with_empty' => false)));
        
        
        $this->setWidget ('isPaid', new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Paid', 0 => 'Not Paid'))));
        $this->widgetSchema->setLabel('isPaid', 'Payment Status');
        
        
        $this->useFields(array(
            'id', 
            'costForm_id', 
            'employee_id', 
            'project_id', 
            'description', 
            'receipt_No',
            'invoice_To', 
            'is_Processed', 
            'invoice_No', 
            'isPaid', 
        ));
        
    }
    
    
    public function addprojectidColumnQuery(Doctrine_Query $query, $field, $value) {
      
        if ($value) {
            
            $query->andWhere('cf.project_id = ?', $value);
        }
    }
    
    
    public function addemployeeidColumnQuery(Doctrine_Query $query, $field, $value) {
        
        if ($value) {
            
            $query->andWhere('cf.user_id = ?', $value);
        }
    }
    
    
    public function addidColumnQuery(Doctrine_Query $query, $field, $value) {
        
        if ($val = $value["text"]) {
            
            $query->andWhere("id = ?", $val  );
        }
    }
    
    
    public function addcostFormidColumnQuery(Doctrine_Query $query, $field, $value) {
        
        if ($val = $value["text"]) {
            
            $query->andWhere("cf.id = ?", $val  );
        }
    }
  
}
