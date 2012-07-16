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
    
    
    
    
    
    public function workingHour_DayItems ($form, $request, $forwardurl, $todayItems) {
        
        if ($request->isMethod('post')) {
          
            $form->bind ($request->getParameter($form->getName()));
        
            if ($form->isValid()) {
                
                $temp = $form->getValues(); //fetching form values
                $msg = ""; //clearing error message
          
                if ($temp["start"]>$temp["end"])
                    $msg = "TO value cannot be smaller than FROM value.";
          
                elseif ($temp["start"]==$temp["end"])
                    $msg = "The time values are the same.";
                
                //checking if overlaps 
                else { 
            
                    $wrong = 0;
                    foreach ($todayItems as $item) {
                        if (
                            ( $temp["start"] > $item["start"] and  $temp["start"] < $item["end"] ) or 
                            ( $temp["end"] > $item["start"] and $temp["end"] < $item["end"] )
                        )
                        $wrong++;
                    }
                    if ($wrong) $msg = "Your time values are interfering with an another interval.";
                }
          
                //if error message set
                if ($msg)  {
                
                    $this->user->setFlash("error", $msg);
                                
                } else  {
                
                    //save form
                    
                    $object = $form->save();
                    
                    $object->setUpdatedBy($this->user->getGuardUser()->getId());
                    
                    if (!$temp["created_by"]) $object->setCreatedBy($this->user->getGuardUser()->getId());
                    $object->save();
                    
                    $this->user->setFlash("success", "Record is added!");
                    $this->controller->redirect($request->getReferer());
                }
            
            } else {
          
                $this->user->setFlash("error", "Problem occured saving the record! Please check your input.");
            }
        
        }
    }
    
}
