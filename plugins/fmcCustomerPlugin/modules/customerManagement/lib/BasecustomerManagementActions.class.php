<?php

abstract class BasecustomerManagementActions extends sfActions
{
  
  
  public function executeList (sfWebRequest $request)
  {
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('Customer u');
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
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
        $this->getUser()->setFlash("success", "Customer info is saved.");
      }
      $this->redirect($request->getReferer());
    }
  }
  
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new customerForm();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $object->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
        $this->getUser()->setFlash("success", "Customer is created.");
        $this->redirect($this->getController()->genUrl("@customerManagement"));
      }
    }
  }
  
}
