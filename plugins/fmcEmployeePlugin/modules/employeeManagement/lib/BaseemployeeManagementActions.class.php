<?php

abstract class BaseemployeeManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('sfGuardUser u')
      ->orderBy('username ASC');
    $filterClass = new FmcFilter('filterform_plugin_sfguarduser');
    $this->employees = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Do not touch here
    if ($request->hasParameter('_reset')) $filterClass->resetForm ();
    $this->filter = $filterClass->getFilter();
    $this->filtered = $filterClass->getFiltered();
  }
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->employee = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->employee);
    
    $this->form = new form_plugin_sfguarduser ($this->employee);
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@employeeManagement", false);
  }
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new form_plugin_sfguarduser_new();
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@employeeManagement", true);
  }
    
}
