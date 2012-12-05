<?php

class filter_costFormUser_list extends PluginCostFormFormFilter {
    
    public function configure() {
        
    	parent::configure();
    	
        $this->useFields(array(
            'project_id', 
        ));
        
        $this->setWidget('project_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Projects'),
            'table_method' => 'getActive',
            'add_empty' => true)
        ));
        
    }
    
}
