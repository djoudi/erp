<?php

class FmcWhUser_Process {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }   
    
    public function workingHour_DayLeaveRequest ($form, $request, $redirectUrl) {
        
        if ($request->isMethod('post')) {
          
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid()) {

                $object = $form->save();
                $object->setUpdatedBy($this->user->getGuardUser()->getId());
                $object->setCreatedBy($this->user->getGuardUser()->getId());
                $object->save();
                
                $this->user->setFlash('success', 'Leave request has been sent.');
                $this->controller->redirect ($redirectUrl);
                
            } else {
                $this->user->setFlash('error', 'Problem occured saving the record! Please check your input.');
            }
        }
    }
    
    public function workingHour_DayEntrance ($form, $request, $redirectUrl) {

      if ($request->isMethod('post')) {
        
          $form->bind ($request->getParameter($form->getName()));
          
          if ($form->isValid()) {
            
              $object = $form->save();
              $object->setUpdatedBy($this->user->getGuardUser()->getId());
              $object->setCreatedBy($this->user->getGuardUser()->getId());
              $object->save();
            
              $this->user->setFlash('success', 'Office day entrance recorded.');
              $this->controller->redirect ($redirectUrl);
              
          }
          else {
              $this->user->setFlash('error', 'Problem occured saving the record! Please check your input.');
          }

      }

    }
    
}
