<?php

abstract class BasecustomerManagementActions extends sfActions
{
  
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->customers = Doctrine::getTable('Customer')->findAll();
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
        $this->form->save();
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
        $this->form->save();
        $this->getUser()->setFlash("success", "Customer is created.");
        $this->redirect($this->getController()->genUrl("@customerManagement"));
      }
    }
  }
  
}
