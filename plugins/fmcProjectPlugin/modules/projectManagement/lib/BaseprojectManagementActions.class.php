<?php

abstract class BaseprojectManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    // Filter: Edit these variables
      $_q = Doctrine_Query::create()
        ->from('Project p')
        ->orderBy('code ASC');
      $filterClass = new FmcFilter('ProjectFormFilter');
      $this->projects = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Filter: Do not touch here
      if ($request->hasParameter('_reset')) $filterClass->resetForm ();
      $this->filter = $filterClass->getFilter();
      $this->filtered = $filterClass->getFiltered();
  }
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->project = Doctrine::getTable('Project')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->project);
    
    $this->form = new projectForm ($this->project);
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@projectManagement", false);
  }
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new projectForm();
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@projectManagement", true);
  }
  
}
