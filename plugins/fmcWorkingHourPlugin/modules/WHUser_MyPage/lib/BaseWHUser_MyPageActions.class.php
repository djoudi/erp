<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    public function executeIndex (sfWebRequest $request)
    {
        $date = date("Y-m-d");
        $this->redirect ($this->getController()->genUrl("@whuser_day?date=".$date));
    }
    
    public function executeDay (sfWebRequest $request)
    {
        if ( ! $this->date = $request->getParameter('date') )
        {
            $this->date = date ("Y-m-d");
        }
        
        
        
        
        
        
        $status = Fmc_Wh_Day::getStatus($this->date);
        
        if ($status == "empty")
        {
        	$this->setTemplate('newday');
        	
        	$formitem = new WorkingHourEntranceExit();
        	$formitem->setType("Enter");
        	#$formitem->setUser($this->user);
        	$formitem->setDayId(0);
        	
        	$this->form = new Form_WHEntranceExit_newday($formitem);
            
            if ($request->isMethod('post'))
            {
                $this->form->bind ($request->getParameter($this->form->getName()));
                if ($this->form->isValid())
                {
                    $day = new WorkingHourDay();
                    $day->setDate($this->date());
                    $day->setUserId($this->getUser()->getGuardUser()->getId());
                    #$day->set
                    //create new day
                    //create new enter record
                    //$this->user->setFlash('success', 'Office day entrance recorded.');
                    //$this->controller->redirect ($redirectUrl);
                }
                else
                {
                    $this->user->setFlash('error', 'Problem occured saving the record! Please check your input.');
                }
            }
        }
        
    }
    
}
