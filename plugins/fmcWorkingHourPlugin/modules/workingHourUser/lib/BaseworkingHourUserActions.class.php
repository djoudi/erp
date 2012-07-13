<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  
    public function executeMyhome (sfWebRequest $request) {
        
    }
  
    public function executeDay (sfWebRequest $request) {
        
        $date = $request->getParameter('date');
        
        $checkClass = new FmcWhUser_Check();
        
        if  ($checkClass->isDayEmpty($date)) {
            
            $this->setTemplate('newday');
            
        } else {
            
            $this->setTemplate('editday');
            
        }
        
    }
    
}
