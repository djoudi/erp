<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  
    public function executeMyhome (sfWebRequest $request) {
        
    }
    
    public function executeMyleaverequests (sfWebRequest $request) {
        
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $this->resultlimit = 100;
        
        $accessClass = new FmcWhUser_Access();
        $query = $accessClass->getMyLeaveRequestsFilterQuery($this->resultlimit);
        
        $filterClass = new FmcFilter('WorkingHourFilter_myleave');
        $this->myLeaveRequests = $filterClass->initFilterForm ($request, $query)->execute()->toArray();
        
        // Filtering inherits
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
        $this->resultslimited = false;
        if (count($this->myLeaveRequests) == $this->resultlimit)
        $this->resultslimited = true;
        
    }
    
    public function executeDeleteday (sfWebRequest $request) {
        
        $date = $request->getParameter ('date');
        
        $accessClass = new FmcWhUser_Access();
        $accessClass->deleteDay ($date);
        
        $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$date);
        $this->redirect ($redirectUrl);
        
    }
    
    public function executeLeaverequest (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        
        $checkClass = new FmcWhUser_Check();
        if ( ! ($checkClass->isDayEmpty($this->date) ) ) {
            
            $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
            $this->redirect ($redirectUrl);
            
        }
        
        $this->type = $request->getParameter('type');
        $user = $this->getUser()->getGuardUser();
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $formitem = new WorkingHourLeave();
        $formitem->setDate($this->date);
        $formitem->setUser($user);
        $formitem->setType($this->type);
        $formitem->setStatus('Pending');
        $formitem->setStatusUser($user);
        
        $this->form = new WorkingHourForm_leavewreport($formitem);
        
        $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_DayLeaveRequest($this->form, $request, $redirectUrl);
        
    }
    
    public function executeDay (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $user = $this->getUser()->getGuardUser();
        
        $checkClass = new FmcWhUser_Check();
        
        if  ($checkClass->isDayEmpty($this->date)) {
            
            $this->setTemplate('newday');
            
            $formitem = new WorkingHourDay();
            $formitem->setType("Enter");
            $formitem->setUser($user);
            $formitem->setDate($this->date);
            $this->form = new WorkingHourForm_enterday($formitem);
            
            $processClass = new FmcWhUser_Process();
            $redirectUrl = '@workingHourUser_day?date='.$this->date;
            $processClass->workingHour_DayEntrance($this->form, $request, $redirectUrl);
            
        } else {
            
            $this->setTemplate('editday');
            
            $this->cancelUrl = $this->getController()->genUrl('@workingHourUser_deleteday?date='.$this->date);
            
            $accessClass = new FmcWhUser_Access();
            
            $this->leaveRequest = $accessClass->getDayLeave($this->date);
            if ($this->leaveRequest) {
                
                $this->setTemplate('leaveinfo');
            
            } else {
                
                
                // Fetching day entrance hourgetDayHours
                    $this->entranceHour = Doctrine::getTable('WorkingHourDay')
                        ->getDayHours($user->getId(), $this->date, "Enter");
                    
                    #$this->entranceHour = $accessClass->getDayEntrance($this->date);
                
                // Fetching current items
                    $this->items = Doctrine::getTable('WorkingHour')
                        ->getByuseranddate($user->getId(), $this->date);
                
                // Preparing new item form
                    $this->item = new WorkingHour();
                    
                    $this->item->setDate($this->date);
                    $this->item->setUser($user);
                    
                    if (!count($this->items))
                        $time = strtotime ($this->entranceHour["time"]);
                    else
                        $time = strtotime ($this->item->getNextHour($this->date));
                    
                    $this->item->setStart(date('H:i',$time));
                    $this->item->setEnd(date('H:i',$time + 1800));
                    
                    $this->form = new WorkingHourForm_dayitemnew ($this->item);
                    
                // Processing form
                    $processClass = new FmcWhUser_Process();
                    $redirectUrl = '@workingHourUser_day?date='.$this->date;
                    $processClass->workingHour_DayItems($this->form, $request, $redirectUrl, $this->items);
            }
            
        }
        
    }
    
}
