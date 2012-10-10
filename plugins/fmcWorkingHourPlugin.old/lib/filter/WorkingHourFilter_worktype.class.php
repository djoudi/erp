<?php

class WorkingHourFilter_worktype extends PluginWorkTypeFormFilter {
    
    public function configure() {
        
        $this->widgetSchema['groups_list']->setLabel('Departments');
        
  }
}
