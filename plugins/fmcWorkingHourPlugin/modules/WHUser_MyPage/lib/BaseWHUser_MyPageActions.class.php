<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        /* Generate today's date */
        $date = date("Y-m-d");
        
        /* Forward to today's date */
        $this->redirect ($this->getController()->genUrl("@whuser_day?date=".$date));
    }
    
    
    
    public function executeLeaverequestselect (sfWebRequest $request)
    {
        /* Get leave types */
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
        
        /* @TODO - can do this with component? */
    }
    
    
    
    public function executeDeleteday (sfWebRequest $request)
    {
        
        WHUser_MyPage_Lib_Form::DeleteMyDay ($request->getParameter('date'));
        
        $this->getUser()->setFlash('notice', "Day records deleted.");
        
        $forwardUrl = $this->getController()->genUrl('@whuser_day?date='.$request->getParameter('date'));
        
        $this->getController()->redirect ($forwardUrl);
        
    }
    
    
    
    public function executeLeaverequestedit (sfWebRequest $request)
    {
        $type_id = $request->getParameter ('type_id');
        $myuser_id = $this->getUser()->getGuardUser()->getId();
        $this->date = $request->getParameter ('date');
        
        if ( ! Fmc_Wh_Day::getHasEnoughLeaveLimit ($type_id, $myuser_id) )
        {
            $this->getUser()->setFlash('error', "You don't have enough limits for this leave type.");
            $url = $this->getController()->genUrl("@whuser_day?date=".$this->date);
            $this->getController()->redirect ($url);
        }
        
        $this->leaveType = Doctrine::getTable('LeaveType')->findOneById($type_id);
        
        $leaveObject = new LeaveRequest();
        $leaveObject->setUserId ($myuser_id);
        $leaveObject->setTypeId ($type_id);
        $leaveObject->setStatus ('Draft');
        $leaveObject->setStartDate ($this->date);
        $leaveObject->setEndDate ($this->date);
        
        if ($this->leaveType['has_Report'])
            $this->form = new Form_WHLeave_w_report ($leaveObject);
        else
            $this->form = new Form_WHLeave_wo_report ($leaveObject);
        
        $this->setTemplate('newleave');
        
        // process
    }
    
    
    
    
    
    
    
    public function executeDay (sfWebRequest $request)
    {
        /* Fetching date or setting today */
            
            if ( ! $this->date = $request->getParameter('date') ) $this->date = date ("Y-m-d");
        
        /* Fetching date status */
        
            $this->status = Fmc_Wh_Day::getStatus($this->date);
        
        
        if ($this->status == "empty")
        {
            /* Fetching all leave types */
            
                $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
            
            /* Preparing entrance form */
            
                $formitem = new WorkingHourEntranceExit();

                $formitem->setType("Enter");
                
                $this->form = new Form_WHEntranceExit_newday($formitem);
            
            /* Processing entrance form */
            
                WHUser_MyPage_Lib_Form::ProcessMyNewDay ($request, $this->form, $this->date);
        }
        
        
        if ($this->status == "workday")
        {
            
            /* Fetching day object */
            
                $day = Doctrine::getTable('WorkingHourDay')->getMyActiveForDate($this->date);
            
            /* Fetching day records */
            
                $this->dayIOrecords = $day->getActiveIORecords();
            
                $this->dayWorkRecords = $day->getActiveWorkRecords();
            
            /* Preparing Work form */
            
                $workObject = new WorkingHourWork();
            
                $workObject->setDayId ($day['id']);
            
                $this->workForm = new Form_WHUser_newdaywork($workObject);
            
            /* Preparing Entrance form */
            
                $entranceObject = new WorkingHourEntranceExit();
            
                $entranceObject->setDayId ($day['id']);
            
                $entranceObject->setType ('Entrance');
            
                $this->entranceForm = new Form_WHUser_newdayio($entranceObject);
            
            /* Preparing Exit form */
            
                $exitObject = new WorkingHourEntranceExit();
                
                $exitObject->setDayId ($day['id']);
            
                $exitObject->setType ('Exit');
                
                $this->exitForm = new Form_WHUser_newdayio($exitObject);
            
            /* @TODO - these process classes should be checked for inconsistency */
            
            /* Processing Forms */
            
                $form_id = $request->getParameter('form_id');
            
                $url = $this->getController()->genUrl('@whuser_day?date='.$this->date);
            
                if ($form_id == 1) FmcCoreProcess::form ($this->workForm, $request, $url);
            
                elseif ($form_id == 2) FmcCoreProcess::form ($this->entranceForm, $request, $url);
                
                elseif ($form_id == 3) FmcCoreProcess::form ($this->exitForm, $request, $url);
        }
        

    }
    
    
}
