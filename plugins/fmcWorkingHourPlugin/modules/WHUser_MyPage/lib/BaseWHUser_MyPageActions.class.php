<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $date = date("Y-m-d");
        $this->redirect ($this->getController()->genUrl("@whuser_day?date=".$date));
    }
    
    
    public function executeLeaverequestlist (sfWebRequest $request)
    {
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
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
        if ( ! $this->date = $request->getParameter('date') )
        {
            $this->date = date ("Y-m-d");
        }
        
        $status = Fmc_Wh_Day::getStatus($this->date);
        
        if ($status == "workday")
        {
            $this->setTemplate ("dayinfo");
            
            $day = Doctrine::getTable('WorkingHourDay')->getMyActiveForDate($this->date);
            
            $object = new WorkingHourWork("test");
            $object->setDayId ($day['id']);
            $this->form = new Form_WHUser_newdaywork($object);
            
            $this->dayIOrecords = $day->getActiveIORecords();
            $this->dayWorkRecords = $day->getActiveWorkRecords();
            
            WHUser_MyPage_Lib_Form::ProcessMyWork ($request, $this->form);
        }
        
        if ($status == "empty")
        {
        	$this->setTemplate('newday');
            
            $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
            
        	$formitem = new WorkingHourEntranceExit();
        	$formitem->setType("Enter");
        	$formitem->setDayId(0);
        	$this->form = new Form_WHEntranceExit_newday($formitem);
            
            WHUser_MyPage_Lib_Form::ProcessMyNewDay ($request, $this->form, $this->date);
        }
    }
    
}
