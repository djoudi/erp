<?php

abstract class BaseWHUser_MyPageActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $date = date("Y-m-d");
        $this->redirect ($this->getController()->genUrl("@whuser_day?date=".$date));
    }
    
    
    
    public function executeLeaverequestselect (sfWebRequest $request)
    {
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
    }
    
    
    
    public function executeDeleteday (sfWebRequest $request)
    {
        $day = Doctrine::getTable('WorkingHourDay')->findOneById($request->getParameter('day_id'));
        $this->forward404Unless ($day);
        
        /* @TODO ogüne bagli olabilecekdiger tum kayitlari (leave, workhours, entrance) sil */
        $day->delete();
        
        $this->getUser()->setFlash('notice', "Day records deleted.");
        $this->getController()->redirect ($request->getReferer());
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
    
    
    
    public function prepare_WorkForm ($day_id)
    {
        $workObject = new WorkingHourWork();
        $workObject->setDayId ($day_id);
        return new Form_WHUser_newdaywork($workObject);
    }
    
    
    
    public function prepare_IOForm ($day_id, $type)
    {
        $ioObject = new WorkingHourEntranceExit();
        $ioObject->setDayId ($day_id);
        $ioObject->setType ($type);
        return new Form_WHUser_newdayio($ioObject);
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
            $this->dayDeleteUrl = $this->getController()->genUrl('@whuser_day_delete?day_id='.$day['id']);
            
            
            /* @TODO: getlasttype fonksiyonu yazılacak*/
            $this->ioTypeCurrent = "Exit";
            
            
            /* Preparing Forms */
            
            
            
            
            
        $workObject = new WorkingHourWork();
        $workObject->setDayId ($day['id']);
        $this->workForm = new Form_WHUser_newdaywork($workObject);
            
            
            
            $ioObject = new WorkingHourEntranceExit();
            $ioObject->setDayId ($day['id']);
            $ioObject->setType ($this->ioTypeCurrent);
            $this->ioForm = new Form_WHUser_newdayio($ioObject);
                    
            
            
            $this->dayIOrecords = $day->getActiveIORecords();
            
            $this->dayWorkRecords = $day->getActiveWorkRecords();
            
            
            /* Processing Forms */
            
            $form_id = $request->getParameter('form_id');
            
            $url = $this->getController()->genUrl('@whuser_day?date='.$this->date);
            
            if ($form_id == 1)
            {
                FmcCoreProcess::form ($this->workForm, $request, $url);
            }
            elseif ($form_id == 2)
            {
                FmcCoreProcess::form ($this->ioForm, $request, $url);
            }
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
