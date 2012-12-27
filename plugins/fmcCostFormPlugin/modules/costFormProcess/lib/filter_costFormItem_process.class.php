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
    }
    
}
