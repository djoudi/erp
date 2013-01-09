<?php

class workingHourLeaveActions extends sfActions
{
    public function executeExportExcel (sfWebRequest $request)
    {
        $item = Doctrine::getTable('LeaveRequest')->getActiveLeave ($request->getParameter('id'));
        
        $this->forward404Unless ($item);
        
        // @TODO : move this to a (excel class perhaps)?
        
        // Creating Excel File
        
        $xfile = sfConfig::get('sf_upload_dir')."/excelTemplates/workingHourLeaveForm.xls";
        
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        
        $objPHPExcel = $objReader->load($xfile);
        
        // Writing Values
        
        $objPHPExcel
            ->setActiveSheetIndex(0)
            ->setCellValue ('A44', 'Printed by '.$this->getUser()->getGuardUser().' on '.date("Y-m-d H:i:s"))
            ->setcellValue ('A45', $_SERVER['HTTP_REFERER'])
            ->setcellValue ('C9', $item->getLeaveType()->getName())
            ->setcellValue ('C10', $item['id'])
            ->setcellValue ('C11', $item->getEmployee()->__toString())
            ->setcellValue ('C12', $item['status'])
            ->setcellValue ('C13', $item['start_Date'])
            ->setcellValue ('C14', $item['end_Date'])
            ->setcellValue ('C15', $item['day_Count'].' day(s)')
            ->setcellValue ('C16', $item['comment']);
        
        $type_id = $item['LeaveType']['id'];
        $employee_id = $item['Employee']['id'];
        $available = whLeaveUser::countAvailableLimit ($type_id, $employee_id);
        $used = whLeaveUser::countUsedLimit ($type_id, $employee_id);
        $reserved = whLeaveUser::countUsedReservedLimit ($type_id, $employee_id);
        $pending = $reserved - $used;
        
        $objPHPExcel
            ->setActiveSheetIndex(0)
            ->setcellValue ('B24', $available )
            ->setcellValue ('B25', $used )
            ->setcellValue ('B26', $pending);
        
        if ($item['LeaveType']['has_Report'])
        {
            $rStatus = $item['report_Received'] ? $item['report_Received'] : "Not received";
            
            $objPHPExcel
                ->setActiveSheetIndex(0)
                ->setcellValue ('A18', "Report Date :")
                ->setcellValue ('A19', "Report Number :")
                ->setcellValue ('A20', "Report Received :")
                ->setcellValue ('C18', $item['report_Date'])
                ->setcellValue ('C19', $item['report_Number'])
                ->setcellValue ('C20', $rStatus);
        }
        
        // Finalizing File
        
        $objPHPExcel->getActiveSheet()->setTitle('WHDB-LeaveForm');
        
        header('Content-Type: application/vnd.ms-excel');
        
        header('Content-Disposition: attachment;filename="fmcdata-LeaveRequest-'.$item['id'].'.xls"');
        
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        $objWriter->save('php://output');
        
        // Redirecting Back
        
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
        if (!$this->date = $request->getParameter ('date'))
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
            //$this->id = 0; - whats this?
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
        
        $this->redirect ($this->getController()->genUrl('@workingHourDay_check'));
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
