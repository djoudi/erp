<?php

class filterform_plugin_sfguarduser extends sfGuardUserFormFilter {
    
    public function configure() {
        
    	parent::configure();
    	
        $this->useFields(array(
            'first_name', 
            'last_name', 
            'title', 
            'email_address', 
            'username', 
            'is_active', 
            'group_id'
        ));
    
        $this->widgetSchema['group_id']->setLabel('Department');
        
    }
    
}
