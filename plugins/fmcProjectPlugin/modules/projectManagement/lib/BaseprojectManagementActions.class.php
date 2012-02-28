<?php

abstract class BaseprojectManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('Project p');
    $filterClass = new FmcFilter('ProjectFormFilter');
    $this->projects = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Do not touch here
    if ($request->hasParameter('_reset')) $filterClass->resetForm ();
    $this->filter = $filterClass->getFilter();
    $this->filtered = $filterClass->getFiltered();
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
        $object = $this->form->save();
        $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
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
        $object = $this->form->save();
        $object->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
        $this->getUser()->setFlash("success", "Project is created.");
        $this->redirect($this->getController()->genUrl("@projectManagement"));
      }
    }
  }
  
}
