<?php
  class FmcProcessForm
  {
    public function __construct ()
    {
      $this->controller = sfContext::getInstance()->getController();
      $this->user = sfContext::getInstance()->getUser();
    }
    
    public function ProcessForm ($form, $request, $forwardurl, $isNew = false)
    {
      if ($request->isMethod('post'))
      {
        $form->bind ($request->getParameter($form->getName()));
        if ($form->isValid())
        {
          $object = $form->save();
          $object->setUpdatedBy($this->user->getGuardUser()->getId());
          if ($isNew) $object->setCreatedBy($this->user->getGuardUser()->getId());
          $object->save();
          
          $this->user->setFlash("success", "Record is saved!");
          $this->controller->redirect($this->controller->genUrl($forwardurl));
        }
        else
        {
          $this->user->setFlash("error", "Problem occured saving the record! Please check your input.");
        }
      }
    }
    
  }
