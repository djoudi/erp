<?php

class filter_costFormUser_list extends PluginCostFormFormFilter {
    
    public function configure() {
    
        unset($this['user_id']);
        unset($this['advanceRecieved']);
        unset($this['currency_id']);
        unset($this['created_at']);
        unset($this['isSent']);
    
        $this->setWidget('project_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Projects'),
            'table_method' => 'getActive',
            'add_empty' => true)
        ));
        
    }
    
}
