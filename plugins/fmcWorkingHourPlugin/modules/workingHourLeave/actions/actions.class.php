<?php

class workingHourLeaveActions extends sfActions
{
    
    public function processRequestForm ($request, $form)
    {
        $user = sfContext::getInstance()->getUser();
        
        $form->bind ($request->getParameter($form->getName()));
        
        $err = NULL;
        $numdays = 0;
        
        if ( ! $form->isValid() ) $err = "Problem with your values, please check your input!";
        
        if (!$err)
        {
            $values = $form->getValues();
            $start = new DateTime ($values["start_Date"]);
            $end = new DateTime ($values["end_Date"]);
            
            if ($start > $end)
                $err = "'Start' date cannot be after 'End' date";
        }
        
        // Check if each day is empty
        
        if (!$err)
        {
            $day = new DateTime ($values["start_Date"]);
            
            do {
                $dayDate = $day->format('Y-m-d');
                
                $dayStatus = Doctrine::getTable('WorkingHourDay')
                    ->getDateType ($dayDate, $user->getGuardUser()->getId());
                
                if ($dayStatus != "Empty")
                {
                    $err = "The date ".$dayDate." is not empty, please check your dates!";
                    break;
                }
                
                // Count number of valid days
                
                if ( ! whDayInfo::isHoliday ($dayDate) ) $numdays++;
                
                $day->add(new DateInterval('P1D'));
            }
            while ( $day <= $end );
        }
        
        if (!$err)
        {
            if ($numdays==0) $err = "You have selected holidays only!";
        }
        
        if (!$err)
        {
            $leaveObject = $form->save();
            $leaveObject->setDayCount ($numdays);
            $leaveObject->save();
            
            // Saving each day
            
            $day = new DateTime ($values["start_Date"]);
            
            do {
                $dayDate = $day->format('Y-m-d');
                var_dump( $dayDate );
                
                if ( ! whDayInfo::isHoliday ($dayDate) )
                {
                    $saveDay = new WorkingHourDay();
                    $saveDay->setEmployee ($user->getGuardUser());
                    $saveDay->setDate ($dayDate);
                    $saveDay->setLeaveId ($leaveObject['id']);
                    $saveDay->save();
                }
                
                $day->add(new DateInterval('P1D'));
                
            } while ( $day <= $end );
        }
        
        return $err;
    }
    
    public function executeNewStandalone (sfWebRequest $request)
    {
    }
    
    
    public function executeNewRequest (sfWebRequest $request)
    {
        if ($this->date = $request->getParameter ('date'))
        {
            $this->date = date ("Y-m-d");
        }
        
        $type_id = $request->getParameter('type_id');
        
        if (!whLeaveUser::hasEnoughLimit ($type_id))
        {
            $this->getUser()->setFlash ('error', "You don't have enough limits for this leave type!");
            whDayInfo::routeDay ($this->date);
        }
        
        $this->leaveType = Doctrine::getTable ('LeaveType')->findOneById ($type_id);
        
        $this->forward404Unless ($this->leaveType);
        
        // Creating Forms
        
        $leaveObject = new LeaveRequest();
        
        $leaveObject->setEmployee ($this->getUser()->getGuardUser());
        $leaveObject->setLeaveType ($this->leaveType);
        $leaveObject->setStatus ('Draft');
        $leaveObject->setStartDate ($this->date);
        $leaveObject->setEndDate ($this->date);
        $leaveObject->setReportDate ($this->date);
        
        if ($this->leaveType['has_Report'])
        {
            $this->form = new whForm_newLeaveWReport ($leaveObject);
        } else {
            $this->form = new whForm_newLeaveWoReport ($leaveObject);
        }
        
        // Processing Forms
        
        if ($request->isMethod('post'))
        {
            if ($err = $this->processRequestForm ($request, $this->form))
            {
                $this->getUser()->setFlash('error', $err);
            }
            else
            {
                $this->getUser()->setFlash('success', "Your leave request is created!");
                $this->redirect ($this->getController()->genUrl('homepage')); //leaveinfo
            }
        }
    }
    
    
    public function executeShowInfo (sfWebRequest $request)
    {
        $this->leaveRequest = Doctrine::getTable ('LeaveRequest')->findOneById ($request->getParameter('leave_id'));
        
        $this->forward404Unless ($this->leaveRequest);
    }
    
}
