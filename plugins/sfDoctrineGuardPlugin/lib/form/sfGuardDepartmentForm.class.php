<?php

class sfGuardDepartmentForm extends PluginsfGuardGroupForm {
  public function setupInheritance()
  {
    parent::setupInheritance();

    unset(
      $this['users_list'],
      $this['permissions_list'],
      $this['description']
    );
    
        
        
        $this->setWidget('worktypes_list', new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Worktypes'),
          'add_empty' => false)
        ));
        
        $this->widgetSchema['worktypes_list'] = new sfWidgetFormSelectDoubleList(array(
          'choices' => $this->widgetSchema['worktypes_list']->getChoices(), 
          'label_associated' => 'Enabled Worktypes',
          'label_unassociated' => 'Available Worktypes'
        ));
        
        $this->widgetSchema['worktypes_list']->setLabel('Worktypes');
        
    
    
  }
  
  
  
}
