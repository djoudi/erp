<?php

abstract class BaseprojectManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->projects = Doctrine::getTable('Project')->findAll();
  }
  
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->project = Doctrine::getTable('Project')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->project);
    $this->form = new projectForm ($this->project);
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash("success", "Project is saved.");
      }
      $this->redirect($request->getReferer());
    }
  }
  
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new projectForm();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash("success", "Project is created.");
        $this->redirect($this->getController()->genUrl("@projectManagement"));
      }
    }
  }
  
  
}
