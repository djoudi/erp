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
  
  /* ########################################################################################## */
  
  public function executeEditday (sfWebRequest $request)
  {
    #$this->x = $this->getUser()->getGuardUser()->getWorkingHourLeave()->toArray();
    
    $leaveClass = new FmcWhLeave();
    
    
    // fetching vars
      $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
      $this->date = $request->getParameter('date');
      $user = $this->getUser()->getGuardUser();
      $editurl = $this->getController()->genUrl('@workingHourUser_editday_enterance?date='.$this->date);
    
    
    $this->x = $leaveClass->getActiveLeaveForDate($this->date);
    
      
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
