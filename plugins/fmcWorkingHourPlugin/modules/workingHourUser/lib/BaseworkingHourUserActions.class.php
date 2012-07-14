<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  
    public function executeMyhome (sfWebRequest $request) {
        
    }
    
    public function executeLeaverequest (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        
        $checkClass = new FmcWhUser_Check();
        if ( ! ($checkClass->isDayEmpty($this->date) ) ) {
            
            $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
            $this->redirect ($redirectUrl);
            
        }
        
        $this->type = $request->getParameter('type');
        $user = $this->getUser()->getGuardUser();
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $formitem = new WorkingHourLeave();
        $formitem->setDate($this->date);
        $formitem->setUser($user);
        $formitem->setType($this->type);
        $formitem->setStatus('Pending');
        $formitem->setStatusUser($user);
        
        $this->form = new WorkingHourForm_leavewreport($formitem);
        
        $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_DayLeaveRequest($this->form, $request, $redirectUrl);
        
    }
    
    public function executeDay (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        $user = $this->getUser()->getGuardUser();
        
        $checkClass = new FmcWhUser_Check();
        if  ($checkClass->isDayEmpty($this->date)) {
            
            $this->setTemplate('newday');
            
            $formitem = new WorkingHourDay();
            $formitem->setType("Enter");
            $formitem->setUser($user);
            $formitem->setDate($this->date);
            $this->form = new WorkingHourForm_enterday($formitem);
            
            $processClass = new FmcWhUser_Process();
            $redirectUrl = '@workingHourUser_day?date='.$this->date;
            $processClass->workingHour_DayEntrance($this->form, $request, $redirectUrl);
            
        } else {
            
            $this->setTemplate('editday');
            
            $getClass = new FmcWhUser_Get();
            $this->leaveRequest = $getClass->getDayLeave($this->date);
            
            if ($this->leaveRequest) {
                
                $this->setTemplate('leaveinfo');
            
            } else {
                
                echo "normal";
                //normal
                
            }
            
        }
        
    }
    
}




















