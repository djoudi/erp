<?php

class FmcWhUser_Process {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        $this->user_id = $this->user->getGuardUser()->getId();
        
    }   
    
    /*################################################################################*/
    
    public function workingHour_MonthyHourSetAll ($request, $redirectUrl) {
    
        if ($request->isMethod('post')) {
            
            $errorMsg = "";
            $limit = intval ($request->getParameter("limit"));
            
            if ( !is_int($limit))
                $errorMsg = "Please enter an integer value";
            
            elseif ($limit < 0)
                $errorMsg = "Please enter a positive value";
            
            if ($errorMsg) {
                
                $this->user->setFlash("error", $errorMsg);
                
            } else {
                
                $q = Doctrine_Query::create()
                    ->update('sfGuardUser u')
                    ->set('u.Monthly_Working_Hours', $limit)
                    ->execute();
                $this->user->setFlash('success', 'Monthy working hours has been set successfully.');
                $this->controller->redirect ($redirectUrl);
            }
        }
    
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
            
            elseif ($limit < 0)
                $errorMsg = "Please enter a positive value";
            
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
    
    public function wh_user_dayexit ($form, $request, $redirectUrl) {
        
        if ($request->isMethod('post')) {
          
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid()) {
                
                $values = $form->getValues(); //fetching form values
                $date = $request->getParameter("date");
                
                $lastHour = Doctrine::getTable ('WorkingHour')
                    ->getLastItem($this->user_id, $date);
                
                if ($lastHour) {
                    
                    if ($lastHour > $values["time"]) {
                        $error = "Your exit hour cannot be earlier then your last record";
                    }
                    
                } else {
                    
                    $entrance = Doctrine::getTable ('WorkingHourDay')
                        ->getDayHours ($this->user_id, $date, "Enter");
                    
                    if ($entrance) {
                        
                        if ($entrance["time"] > $values["time"]) {
                            $error = "Your exit hour cannot be earlier than your entrance";
                        }
                    }
                    
                }
                
                if (isset($error)) {
                    
                    $this->user->setFlash('error', $error);
                    
                } else {
                    
                    $object = $form->save();
                    $object->setUpdatedBy($this->user_id);
                    $object->setCreatedBy($this->user_id);
                    $object->save();
                    
                    $this->user->setFlash('success', 'Office exit hour has been sent.');
                    $this->controller->redirect ($redirectUrl);
                }
                
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
