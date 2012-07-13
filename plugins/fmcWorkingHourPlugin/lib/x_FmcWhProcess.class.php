<?php

class FmcWhProcess
{
  public function __construct ()
  {
    $this->controller = sfContext::getInstance()->getController();
    $this->user = sfContext::getInstance()->getUser();
  }
  
  public function ProcessEnteranceExit ($form, $request, $forwardurl, $type)
  {
    if ($request->isMethod('post'))
    {
      $form->bind ($request->getParameter($form->getName()));
      if ($form->isValid())
      {
        $temp = $form->getValues();
        
        $proc = new FmcWhCheck();
        if ($type=='Enterance')
          $proc->EnterTimeValid ($temp['date'], $temp['start']);
        elseif ($type=='Exit')
          $proc->ExitTimeValid ($temp['date'], $temp['start']);
        
        $object = $form->save();
        
        if ($type=='Enterance')
          $object->setEnd($temp['start']);
        elseif ($type=='Exit')
          $object->setStart($temp['end']);
        
        $object->setUpdatedBy($this->user->getGuardUser()->getId());
        if (!$temp["created_by"]) $object->setCreatedBy($this->user->getGuardUser()->getId());
        $object->save();
        
        $this->user->setFlash("success", "Record is added!");
        $this->controller->redirect($forwardurl);
      }
      else
      {
        $this->user->setFlash("error", "Problem occured saving the record! Please check your input.");
      }
    }
  }
  
}
