<?php

abstract class BasecurrencyManagementActions extends sfActions
{
  
  
  ##########################################################################################
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->list = Doctrine::getTable('Currency')->createQuery()->orderBy('code ASC')->execute();
    
    $this->form = new form_plugin_currency_add();
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $object->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
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
      $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
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
    $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
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
      $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $object->save();
      $this->getUser()->setFlash("notice", sprintf("Currency %s is now default!", $object->getCode()));
    }
    
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
}






