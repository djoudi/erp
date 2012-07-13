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
            
        } else {
            
            $this->setTemplate('editday');
            
        }
        
    }
    
}
