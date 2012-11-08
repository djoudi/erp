<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    public function executeIndex (sfWebRequest $request)
    {
        
    }
    
    public function executeDay (sfWebRequest $request)
    {
        $this->date = $request->getParameter('date');
        
        $status = Fmc_Wh_Day::getStatus($this->date);
        
        if ($status == "empty")
        {
        	$this->setTemplate('newday');
        	
        	$formitem = new WorkingHourEntranceExit();
        	$formitem->setType("Enter");
        	#$formitem->setUser($this->user);
        	$formitem->setDayId(0);
        	
        	$this->form = new Form_WHEntranceExit_newday($formitem);
        }
        
    }
    
}
