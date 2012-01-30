<?php

abstract class BasecurrencyManagementActions extends sfActions
{
  
  
  ##########################################################################################
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->list = Doctrine::getTable('Currency')->findAll();
    
    $this->form = new form_plugin_currency_add();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->redirect($request->getReferer());
      }
    }
  }
  
  ##########################################################################################
  
  public function executeDisable (sfWebRequest $request)
  {
    $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    if ($object->getIsDefault())
    {
      $this->getUser()->setFlash("error", sprintf("You cannot disable this currency because it is default!"));
    }
    else
    {
      $object->setIsActive(false);
      $object->save();
      $this->getUser()->setFlash("notice", sprintf("Currency %s is disabled!", $object->getCode()));
    }
    
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
  public function executeEnable (sfWebRequest $request)
  {
    $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    $object->setIsActive(true);
    $object->save();
    
    $this->getUser()->setFlash("notice", sprintf("Currency %s is enabled!", $object->getCode()));
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
  public function executeMakeDefault (sfWebRequest $request)
  {
    $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    if (!$object->getIsActive())
    {
      $this->getUser()->setFlash("error", "You cannot make a disabled currency default!");
    }
    else
    {
      if ( $oldDefault = Doctrine::getTable('Currency')->findOneByisDefault(true) )
      {
        $oldDefault->setIsDefault(false);
        $oldDefault->save();
      }
      $object->setIsDefault(true);
      $object->save();
      $this->getUser()->setFlash("notice", sprintf("Currency %s is now default!", $object->getCode()));
    }
    
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
}






