<?php

class workingHourLeaveActions extends sfActions
{
    public function executeExportExcel (sfWebRequest $request)
    {
        $item = Doctrine::getTable('LeaveRequest')->getActiveLeave ($request->getParameter('id'));
        
        $this->forward404Unless ($item);
        
        // Excel parameters
        
        $template = sfConfig::get('sf_upload_dir')."/excelTemplates/workingHourLeaveForm.xls";
        $title = 'WHDB-LeaveForm';
        $filename = "fmcdata-LeaveRequest-{$item['id']}.xls";
        
        // Preparing values
        
        $values = array();
        
        $values["C9"] = $item->getLeaveType()->getName();
        $values["C10"] = $item['id'];
        $values["C11"] = $item->getEmployee()->__toString();
        $values["C12"] = $item['status'];
        $values["C13"] = $item['start_Date'];
        $values["C14"] = $item['end_Date'];
        $values["C15"] = "{$item['day_Count']} day(s)";
        $values["C16"] = $item['comment'];
        
        $type_id = $item['LeaveType']['id'];
        $employee_id = $item['Employee']['id'];
        $available = whLeaveUser::countAvailableLimit ($type_id, $employee_id);
        $used = whLeaveUser::countUsedLimit ($type_id, $employee_id);
        $reserved = whLeaveUser::countUsedReservedLimit ($type_id, $employee_id);
        
        $values["B24"] = $available;
        $values["B25"] = $used;
        $values["B26"] = $reserved - $used;
        
        if ($item['LeaveType']['has_Report'])
        {
            $rStatus = $item['report_Received'] ? $item['report_Received'] : "Not received";
            
            $values["A18"] = "Report Date :";
            $values["A19"] = "Report Number :";
            $values["A20"] = "Report Received :";
            $values["C18"] = $item['report_Date'];
            $values["C19"] = $item['report_Number'];
            $values["C20"] = $rStatus;
        }
        
        // Preparing output
        
        FmcExcel::prepare ($template, $title, $filename, $values, "A44", "A45");
        
        $this->redirect($request->getReferer());
    }
    
    
    
    
    public function processRequestForm ($request, $form, $type_id)
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
                
                if ( ! whDayInfo::isVacation ($dayDate) ) $numdays++;
                
                $day->add(new DateInterval('P1D'));
            }
            while ( $day <= $end );
        }
        
        if (!$err)
        {
            if ($values["is_half_day"])
            {
                if ($start != $end)
                {
                    $err = "You can only create half-day request only for one day at a time!";
                }
                else
                {
                    $numdays = "0.5";
                }
            }
        }
        
        if (!$err)
        {
            if ($numdays==0) $err = "You have selected holidays only!";
        }
        
        if (!$err)
        {
            $used = whLeaveUser::countUsedReservedLimit ($type_id);
            $available = whLeaveUser::countAvailableLimit ($type_id);
            
            if ($numdays > ($available-$used))
                $err = "You don't have enough limit for this leave type!";
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
                
                if ( ! whDayInfo::isVacation ($dayDate) )
                {
                    $saveDay = new WorkingHourDay();
                    $saveDay->setEmployee ($user->getGuardUser());
                    $saveDay->setDate ($dayDate);
                    $saveDay->setLeaveId ($leaveObject['id']);
                    $saveDay->save();
                }
                
                $day->add(new DateInterval('P1D'));
                
            } while ( $day <= $end );
            
            $this->getUser()->setFlash('leaveRequestId', $leaveObject['id']);
        }
        
        return $err;
    }
    
    
    public function executeNewStandalone (sfWebRequest $request)
    {
        $this->date = date ("Y-m-d");
    }
    
    
    public function executeNewRequest (sfWebRequest $request)
    {
        // Getting date
            
            if (!$this->date = $request->getParameter ('date'))
            {
                $this->date = date ("Y-m-d");
            }
        
        // Getting type
            
            $type_id = $request->getParameter('type_id');
        
        // Check if employee has enough limits for the type
            
            if (!whLeaveUser::hasEnoughLimit ($type_id))
            {
                $this->getUser()->setFlash ('error', "You don't have enough limits for this leave type!");
                whDayInfo::routeDay ($this->date);
            }
        
        // Getting leave type
            
            $this->leaveType = Doctrine::getTable ('LeaveType')->findOneById ($type_id);
            
            $this->forward404Unless ($this->leaveType);
            
        // Creating leave request object
        
            $leaveObject = new LeaveRequest();
            $leaveObject->setEmployee ($this->getUser()->getGuardUser());
            $leaveObject->setLeaveType ($this->leaveType);
            $leaveObject->setStatus ('Draft');
            $leaveObject->setStartDate ($this->date);
            $leaveObject->setEndDate ($this->date);
            $leaveObject->setReportDate ($this->date);
        
        // Creating leave request form
        
            if ($this->leaveType['has_Report'])
            {
                $this->form = new whForm_newLeaveWReport ($leaveObject);
            } else {
                $this->form = new whForm_newLeaveWoReport ($leaveObject);
            }
        
        // Processing Forms
        
        if ($request->isMethod('post'))
        {
            if ($err = $this->processRequestForm ($request, $this->form, $type_id))
            {
                $this->getUser()->setFlash('error', $err);
            }
            else
            {
                $this->getUser()->setFlash('success', "Your leave request is created!");
                
                $id = $this->getUser()->getFlash('leaveRequestId');
                
                $this->redirect ($this->getController()->genUrl('@workingHourLeave_info?leave_id='.$id));
            }
        }
    }
    
    
    public function executeShowInfo (sfWebRequest $request)
    {
        $this->admin = 0;
        
        $id = $request->getParameter ('leave_id');
        
        $this->leaveRequest = Doctrine::getTable ('LeaveRequest')->getActiveLeave ($id);
        
        $this->forward404Unless ($this->leaveRequest);
        
        $this->date = $this->leaveRequest['start_Date'];
    }
    
    
    public function executeSend (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $leaveRequest = Doctrine::getTable ('LeaveRequest')->getDraftLeave ($id);
        
        $this->forward404Unless ($leaveRequest);
        
        $date = new DateTime ($leaveRequest["start_Date"]);
        
        $end = new DateTime ($leaveRequest["end_Date"]);
        
        do
        {
            $dayDate = $date->format('Y-m-d');
            
            $day = Doctrine::getTable('WorkingHourDay')->getDraftDate($dayDate);
            
            if ($day)
            {
                $day->setStatus('Pending');
                
                $day->save();
            }
            
            $date->add(new DateInterval('P1D'));
        }
        while ( $date <= $end );
        
        $leaveRequest->setStatus('Pending');
        
        $leaveRequest->save();
        
        $this->getUser()->setFlash ('notice', 'Leave request with ID '.$id.' is sent for approval.');
        
        $this->redirect ($this->getController()->genUrl("@workingHourLeave_info?leave_id={$id}"));
    }
    
    
    public function executeCancel (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $leaveRequest = Doctrine::getTable ('LeaveRequest')->getDraftLeave ($id);
        
        $this->forward404Unless ($leaveRequest);
        
        $date = new DateTime ($leaveRequest["start_Date"]);
        
        $end = new DateTime ($leaveRequest["end_Date"]);
        
        do
        {
            $dayDate = $date->format('Y-m-d');
            
            $day = Doctrine::getTable('WorkingHourDay')->getDraftDate($dayDate);
            
            if ($day) $day->delete();
            
            $date->add(new DateInterval('P1D'));
        }
        while ( $date <= $end );
        
        $leaveRequest->delete();
        
        $this->getUser()->setFlash ('notice', 'Leave request with ID '.$id.' deleted.');
        
        $this->redirect ($this->getController()->genUrl('@workingHourDay_check'));
    }
    
    
    public function executeMyRequests (sfWebRequest $request)
    {
        $this->allRequests = Doctrine::getTable ('LeaveRequest')->getRequestsForUser ();
        
        $this->acceptedRequests = Doctrine::getTable ('LeaveRequest')
            ->getRequestsForUser ("Accepted");
        
        $this->date = date ("Y-m-d");
    }
    
}
