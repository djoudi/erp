<?php

class ProjectForm extends PluginProjectForm
{
  public function configure()
  {
    $this->widgetSchema->setLabel('code', 'Project Code');
    $this->widgetSchema->setLabel('title', 'Project Title');
    
    
    
  }
}
