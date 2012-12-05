<?php

class filterform_department extends sfGuardGroupFormFilter {
    
    public function configure() {
        
    	parent::configure();
    	
        $this->useFields(array(
            'name', 
            'manager_id', 
        ));
        
    }
    
}
