<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  public function executeLeaverequest (sfWebRequest $request)
  {
    //preparing vars
      $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
      $this->date = $request->getParameter('date');
      $this->type = $request->getParameter('type');
      $user = $this->getUser()->getGuardUser();
      $forwardurl = $this->getController()->genUrl('@workingHourUser_editday?date='.$this->date);
      
    //preparing form
      $formitem = new WorkingHourLeave();
      $formitem->setDate($this->date);
      $formitem->setReportDate($this->date);
      $formitem->setUser($user);
      $formitem->setType($this->type);
      $formitem->setStatus('Pending');
      $formitem->setStatusUser($user);
      $this->form = new WorkingHourForm_leavewreport($formitem);
    
    //processing form
      $processClass = new FmcProcessForm();
      $processClass->ProcessLeaveForm($this->form, $request, $forwardurl);
  }
  
  /* ########################################################################################## */
  
  public function executeHome (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->todayItems = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), date('Y-m-d'));
    $this->lastItems = Doctrine::getTable('WorkingHour')->getLastItems($user->getId(), 5);
  }
  
  
  
    
    
    /*##########################################################################################*/
    
    
    public function executeEnterday (sfWebRequest $request) {
      
      // Fetching variables
      
          $this->date = $request->getParameter('date');
          $user = $this->getUser()->getGuardUser();
        
      // Checking if day has a enter record - already
        
          $checkClass = new FmcWhCheck();
        
          if ($checkClass->hasEnter($this->date)) {
            
              $redirectUrl = '@workingHourUser_editday?date='.$this->date;
              $this->redirect($this->getController()->genUrl($redirectUrl));
          }
      
      // Preparing form
      
          $formitem = new WorkingHourDay();
          $formitem->setType("Enter");
          $formitem->setUser($user);
          $formitem->setDate($this->date);
          $this->form = new WorkingHourForm_enterday($formitem);
      
      // Processing form
            
          $processClass = new FmcProcessForm();
          $redirectUrl = '@workingHourUser_enterday?date='.$this->date;
          $processClass->workingHour_DayEntrance($this->form, $request, $redirectUrl);
      
    }
    
    
    /*##########################################################################################*/
    
    
    public function executeEditday (sfWebRequest $request) {
    
      // Fetching variables
    
          $this->date = $request->getParameter('date');
          $user = $this->getUser()->getGuardUser();
    
      // Checking if day has a enter record
    
          $checkClass = new FmcWhCheck();
        
          if (! $checkClass->hasEnter($this->date)) {
              
              $this->getUser()->setFlash("notice", "You should state an entrance hour first.");
              $redirectUrl = '@workingHourUser_enterday?date='.$this->date;
              $this->redirect($this->getController()->genUrl($redirectUrl));
            
          }
            
      // Getting day entrance
      
          $this->entrance = Doctrine::getTable('workingHourDay')->getEntranceForDate($user->getId(), $this->date);
          
    
    
    
    
    
    
    
    
    
    // Fetching configurations
      
      
    
      $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
    #  $editurl = $this->getController()->genUrl('@workingHourUser_editday_enterance?date='.$this->date);
    $editurl = "";
    
    
      $leaveClass = new FmcWhLeave();
      $this->leaveRequest = $leaveClass->getActiveLeaveForDate($this->date);
      
    // fetching todays items
      $this->items = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), $this->date);
    
    // preparing form
      $this->item = new WorkingHour();
      $this->item->setDate($this->date);
      $this->item->setUser($user);
      $time = strtotime($this->item->getNexthour($this->date));
      $this->item->setStart(date('H:i',$time));
      $this->item->setEnd(date('H:i',$time + 1800));
      $this->form = new WorkingHourForm_User ($this->item);
      
    // processing form
      $processClass = new FmcProcessForm();
      $processClass->ProcessWorkingHourForm($this->form, $request, $editurl, $this->items);
    # process kismi duzeltilecek - aktarilacak
    
  
  }
}
