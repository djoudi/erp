<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    public function executeIndex (sfWebRequest $request)
    {
        $date = date("Y-m-d");
        $this->redirect ($this->getController()->genUrl("@whuser_day?date=".$date));
    }
    
    
    public function executeNewleave (sfWebRequest $request)
    {
        $type_id = $request->getParameter ('type');
        $myuser_id = $this->getUser()->getGuardUser()->getId();
        $this->date = $request->getParameter ('date');
        
        // yeterli hakki var mi kontrol
        
        $leaveObject = new LeaveRequest();
        $leaveObject->setUserId ($myuser_id);
        $leaveObject->setTypeId ($type_id);
        $leaveObject->setStatus ('Draft');
        $leaveObject->setStartDate ($this->date);
        $leaveObject->setEndDate ($this->date);
        
        $this->form = new LeaveRequestForm ($leaveObject);
        // report varligina gore formu getir
        
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
            
            $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
            
            
        	
        	$formitem = new WorkingHourEntranceExit();
        	$formitem->setType("Enter");
        	$formitem->setDayId(0);
        	
        	$this->form = new Form_WHEntranceExit_newday($formitem);
            
            if ($request->isMethod('post'))
            {
                $this->form->bind ($request->getParameter($this->form->getName()));
                if ($this->form->isValid())
                {
                    $values = $this->form->getValues();
                    
                    $day = new WorkingHourDay();
                    $day->setUserId ($this->getUser()->getGuardUser()->getId());
                    $day->setDate ($this->date);
                    $day->setStatus ("Draft");
                    $day->setMultiplier (Fmc_Wh_Day::getMultiplier($this->date));
                    $day->save();
                    
                    $entrance = new WorkingHourEntranceExit();
                    $entrance->setDay ($day);
                    $entrance->setType ("Entrance");
                    $entrance->setTime ($values["time"]);
                    $entrance->save();
                    
                    $this->user->setFlash('success', 'Office day entrance saved.');
                    $this->controller->redirect ($request->getReferer());
                }
                else
                {
                    $this->user->setFlash('error', 'Problem occured saving the record! Please check your input.');
                }
            }
        }
        
    }
    
}
