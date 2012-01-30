<?php

class ProjectForm extends PluginProjectForm
{
  public function configure()
  {
    $this->widgetSchema->setLabel('code', 'Project Code');
    $this->widgetSchema->setLabel('title', 'Project Title');
    
    
    $this->setWidget('customer_id', new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Customers'),
      'table_method' => 'getOrdered',
      'add_empty' => false)
    ));
    
  }
}
