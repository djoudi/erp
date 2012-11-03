<?php

abstract class BasecustomerManagementActions extends sfActions
{
  public function executeList (sfWebRequest $request)
  {
    // Filter: Edit these variables
      $_q = Doctrine_Query::create()
        ->from('Customer u')
        ->orderBy('name ASC');
      $filterClass = new FmcFilter('CustomerFormFilter');
      $this->customers = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Filter: Do not touch here
      if ($request->hasParameter('_reset')) $filterClass->resetForm ();
      $this->filter = $filterClass->getFilter();
      $this->filtered = $filterClass->getFiltered();
  }
  
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->item = Doctrine::getTable('Customer')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->item);
    
    $this->form = new customerForm ($this->item);
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@customerManagement", false);
  }
  
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new customerForm();
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@customerManagement", true);
  }
  
}
