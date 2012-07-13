<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  
    public function executeMyhome (sfWebRequest $request) {
        
    }
  
    public function executeDay (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
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
            
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
            
        } else {
            
            $this->setTemplate('editday');
            
        }
        
    }
    
}
