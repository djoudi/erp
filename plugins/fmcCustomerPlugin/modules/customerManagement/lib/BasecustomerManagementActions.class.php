<?php

abstract class BasecustomerManagementActions extends sfActions
{
  public function executeList (sfWebRequest $request)
  {
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('Customer u')
      ->orderBy('name ASC');
    $filterClass = new FmcFilter('CustomerFormFilter');
    $this->customers = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Do not touch here
    if ($request->hasParameter('_reset')) $filterClass->resetForm ();
    $this->filter = $filterClass->getFilter();
    $this->filtered = $filterClass->getFiltered();
  }
  
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->customer = Doctrine::getTable('Customer')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->customer);
    
    $this->form = new customerForm ($this->customer);
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
