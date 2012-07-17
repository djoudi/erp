<?php

class WorkingHourForm_worktype extends PluginWorkTypeForm {
    
    public function configure() {
        
        $this->setWidget('groups_list', new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Groups'),
          'add_empty' => false)
        ));
    
        $this->widgetSchema['groups_list'] = new sfWidgetFormSelectDoubleList(array(
          'choices' => $this->widgetSchema['groups_list']->getChoices(), 
          'label_associated' => 'Enabled Departments',
          'label_unassociated' => 'Available Departments'
        ));
        
        $this->widgetSchema['groups_list']->setLabel('Departments');
        
    }

}
