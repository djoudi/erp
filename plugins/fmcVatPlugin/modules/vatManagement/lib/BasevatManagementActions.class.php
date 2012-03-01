<?php

abstract class BasevatManagementActions extends sfActions
{
  
  
  ##########################################################################################
  
  public function executeIndex (sfWebRequest $request)
  {
    $this->list = Doctrine::getTable('Vat')->createQuery()->orderBy('rate ASC')->execute();
    
    $this->form = new form_plugin_vat_add();
    
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
    $object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    if ($object->getIsDefault())
    {
      $this->getUser()->setFlash("error", sprintf("You cannot disable this VAT because it is default!"));
    }
    else
    {
      $object->setIsActive(false);
      $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $object->save();
      
      $this->getUser()->setFlash("notice", sprintf("Vat rate %s is disabled!", $object->getRate()));
    }
    
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
  public function executeEnable (sfWebRequest $request)
  {
    $object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    $object->setIsActive(true);
    $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
    $object->save();
    
    $this->getUser()->setFlash("notice", sprintf("Vat %s is enabled!", $object->getRate()));
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
  public function executeMakeDefault (sfWebRequest $request)
  {
    $object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id'));
    $this->forward404Unless ($object);
    
    if (!$object->getIsActive())
    {
      $this->getUser()->setFlash("error", "You cannot make a disabled currency default!");
    }
    else
    {
      if ( $oldDefault = Doctrine::getTable('Vat')->findOneByisDefault(true) )
      {
        $oldDefault->setIsDefault(false);
        $oldDefault->save();
      }
      $object->setIsDefault(true);
      $object->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $object->save();
      $this->getUser()->setFlash("notice", sprintf("VAT ratio %d is now default!", $object->getRate() ));
    }
    
    $this->redirect($request->getReferer());
  }
  
  ##########################################################################################
  
}






