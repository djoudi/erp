<?php

abstract class BaseemployeeManagementActions extends sfActions
{
  
  public function executeIndex (sfWebRequest $request)
  {
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('sfGuardUser u')
      ->orderBy('id ASC');
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
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
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
        $object = $this->form->save();
        $object->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
        $this->getUser()->setFlash("success", "Employee is created.");
        $this->redirect($this->getController()->genUrl("@employeeManagement"));
      }
    }
  }
    
}
