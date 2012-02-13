<?php

abstract class BasecostFormManageActions extends sfActions
{
  public function executeEdit (sfWebRequest $request)
  {
    $this->cost = Doctrine::getTable('CostFormItem')->findOneById($request->getParameter('cost_id'));
    $this->forward404Unless ($this->cost);
    
    $this->form = new form_costFormUser_newItem($this->cost);
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash("success", "Cost form is saved.");
        $this->redirect($request->getReferer());
      }
    }
  }
  
  public function executeDelete (sfWebRequest $request)
  {
    $this->cost = Doctrine::getTable('CostFormItem')->findOneById($request->getParameter('cost_id'));
    $this->forward404Unless ($this->cost);
    
    $this->cost->delete();
    $this->getUser()->setFlash("success", "Cost form is deleted.");
    $this->redirect($request->getReferer());
  }
}
