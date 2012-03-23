<?php
  class FmcProcessWh
  {
    public function __construct ()
    {
      $this->controller = sfContext::getInstance()->getController();
      $this->user = sfContext::getInstance()->getUser();
    }
    
    public function ProcessEnterance ($form, $request, $forwardurl)
    {
      if ($request->isMethod('post'))
      {
        $form->bind ($request->getParameter($form->getName()));
        if ($form->isValid())
        {
          $temp = $form->getValues();
          
          # yapilacak kontroller:
          # son girisi ve son cikisi al
          # eger son giris varsa ve cikis yoksa, cikissiz giris de
          # eger son giris ve cikis varsa, cikis<giris ise cikissiz giris de
          
          $object = $form->save();
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
    
    
    /*
    public function ProcessWorkingHourForm ($form, $request, $forwardurl, $todayItems)
    {
      if ($request->isMethod('post'))
      {
        $form->bind ($request->getParameter($form->getName()));
        if ($form->isValid())
        {
          $temp = $form->getValues(); //fetching form values
          $msg = ""; //clearing error message
          
          if ($temp["start"]>$temp["end"])
            $msg = "TO value cannot be smaller than FROM value.";
          
          elseif ($temp["start"]==$temp["end"])
            $msg = "The time values are the same.";
          
          else //checking if overlaps
          {
            $wrong = 0;
            foreach ($todayItems as $item)
            {
              if (
                ( $temp["start"] > $item["start"] and  $temp["start"] < $item["end"] ) or 
                ( $temp["end"] > $item["start"] and $temp["end"] < $item["end"] )
              )
              $wrong++;
            }
            if ($wrong) $msg = "Your time values are interfering with an another interval.";
          }
          
          if ($msg) //if error message set
          {
            $this->user->setFlash("error", $msg);
          }
          else //save form
          {
            $object = $form->save();
            $object->setUpdatedBy($this->user->getGuardUser()->getId());
            if (!$temp["created_by"]) $object->setCreatedBy($this->user->getGuardUser()->getId());
            $object->save();
            $this->user->setFlash("success", "Record is added!");
            $this->controller->redirect($request->getReferer());
          }
        }
        else
        {
          $this->user->setFlash("error", "Problem occured saving the record! Please check your input.");
        }
      }
    }
    
    
    public function ProcessForm ($form, $request, $forwardurl, $isNew = false, $withid = false)
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
          
          // For costform-user-new
          if ($withid) $redirecturl = $this->controller->genUrl($forwardurl.'?id='.$object->id);
          elseif ($forwardurl=="referer") $redirecturl = $request->getReferer();
          else $redirecturl = $this->controller->genUrl($forwardurl);
          
          $this->controller->redirect($redirecturl);
        }
        else
        {
          $this->user->setFlash("error", "Problem occured saving the record! Please check your input.");
        }
      }
    }
    */
  }
