<?php

abstract class BaseemployeeManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->employees = Doctrine::getTable('sfGuardUser')->createQuery()->orderBy('id ASC')->execute();
  }
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->employee = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->employee);
    $this->form = new form_plugin_sfguarduser ($this->employee);
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash("success", "Employee info is saved.");
        $this->redirect($request->getReferer());
      }
      
    }
  }
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new form_plugin_sfguarduser_new();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash("success", "Employee is created.");
        $this->redirect($this->getController()->genUrl("@employeeManagement"));
      }
    }
  }
    
}





