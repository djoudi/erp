<?php

class form_plugin_sfguardgroup extends sfGuardGroupForm {
    
    public function configure() {
        
        $this->setWidget('worktypes_list', new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Worktypes'),
          'table_method' => 'getOrdered',
          'add_empty' => false)
        ));
        
        $this->widgetSchema['worktypes_list'] = new sfWidgetFormSelectDoubleList(array(
          'choices' => $this->widgetSchema['worktypes_list']->getChoices(), 
          'label_associated' => 'Enabled Worktypes',
          'label_unassociated' => 'Available Worktypes'
        ));
        
        $this->widgetSchema['worktypes_list']->setLabel('Department');
        
    }
}
