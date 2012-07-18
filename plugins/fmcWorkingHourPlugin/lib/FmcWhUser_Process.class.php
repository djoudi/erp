<?php

class FmcWhUser_Process {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }   
    
    /*################################################################################*/
    
    public function workingHour_LeaveSetAll ($request, $redirectUrl) {
        
        if ($request->isMethod('post')) {
            
            $errorMsg = "";
            $type = $request->getParameter("type");
            $limit = intval ($request->getParameter("limit"));
            
            if ( !$type or !$limit)
                $errorMsg = "Please fill all fields";
            
            elseif ( !is_int($limit))
                $errorMsg = "Please enter an integer value";
            
            if ($errorMsg) {
                
                $this->user->setFlash("error", $errorMsg);
                
            } else {
                
                $q = Doctrine_Query::create()
                    ->update('sfGuardUser u')
                    ->set('u.'.$type.'Limit', $limit)
                    ->execute();
                $this->user->setFlash('success', 'Leave limits has been set successfully.');
                $this->controller->redirect ($redirectUrl);
            }
            
        }
        
    }
    
    /*################################################################################*/
    
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
    
    /*################################################################################*/
    
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
    
    /*################################################################################*/
    
    public function workingHour_DayItems ($form, $request, $forwardurl, $todayItems) {
        
        if ($request->isMethod('post')) {
          
            $form->bind ($request->getParameter($form->getName()));
        
            if ($form->isValid()) {
                
                $formValues = $form->getValues(); //fetching form values
                $msg = ""; //clearing error message
          
                if ($formValues["start"] > $formValues["end"])
                    $msg = "TO value cannot be smaller than FROM value.";
                
                elseif ($formValues["start"] == $formValues["end"])
                    $msg = "The time values are the same.";
                
                //checking if overlaps 
                else { 
            
                    $wrong = 0;
                    foreach ($todayItems as $item) {
                        
                        if ( $formValues["start"] > $item["start"] and  $formValues["start"] < $item["end"] )
                            $wrong++;
                        
                        if ( $formValues["end"] > $item["start"] and $formValues["end"] < $item["end"] )
                            $wrong++;
                        
                        // if any item is between entered values
                        if ( $item["start"] > $formValues["start"] and $item["end"] < $formValues["end"])
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
                    
                    if (!$formValues["created_by"]) $object->setCreatedBy($this->user->getGuardUser()->getId());
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
