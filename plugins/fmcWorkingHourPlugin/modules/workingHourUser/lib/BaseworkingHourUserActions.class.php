<?php

abstract class BaseworkingHourUserActions extends sfActions {
    
    public function executeMyhome (sfWebRequest $request) {
        
        // Preparing variables
            $today = date ( "Y-m-d", mktime(0,0,0,date("m"),date("d"),date("Y")) );
            $this->todayUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$today);
        
        // Loading configuration
            $user = $this->getUser()->getGuardUser();
            $user_id = $user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
            
        // Loading custom classes
            $checkClass = new FmcWhUser_Check();
            $accessClass = new FmcWhUser_Access();
        
        // Getting day type
            $dayType = $checkClass->getDayType ($user_id, $today);
        
        // Checking day type
        
            if ($dayType == "empty") {
                
                $this->todayType = "empty";
            
            } else if ($dayType == "leave") {
                
                $this->todayType = "leave";
                $this->leaveRequest = $accessClass->getDayLeave($today);
                
            } else if ($dayType == "work") {
                
                $this->todayType = "normal";
                $this->entranceHour = Doctrine::getTable('WorkingHourDay')
                    ->getDayHours($user_id, $today, "Enter");
                $this->items = Doctrine::getTable('WorkingHour')
                    ->getByuseranddate($user_id, $today);
                
            }
        
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
        
        // Fetching parameters
        
            $this->date = $request->getParameter('date');
            $this->type = $request->getParameter('type');
        
        // Loading configuration
            $user = $this->getUser()->getGuardUser();
            $user_id = $user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        // Loading check class
        
            $checkClass = new FmcWhUser_Check();
            
        // Checking if day is empty and available
            
            $dayType = $checkClass->getDayType ($user_id, $this->date);
            
            if ( ! $dayType == "empty" ) {
        
            //if ( ! ($checkClass->isDayEmpty($this->date) ) ) {
                
                $this->getUser()->setFlash("error", "Day is not empty.");
                
                $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
                $this->redirect ($redirectUrl);
            }
        
        // Checking if user has enough limits
        
            if ( ! ($checkClass->hasLeaveLimit ($this->type)) ) {
                
                $this->getUser()->setFlash("error", "You don't have available limits.");
                
                $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
                $this->redirect ($redirectUrl);
            }
        
        // Preparing leave request form        
            $formitem = new WorkingHourLeave();
            $formitem->setDate($this->date);
            $formitem->setUser($user);
            $formitem->setType($this->type);
            $formitem->setStatus('Pending');
            $formitem->setStatusUser($user);
            $this->form = new WorkingHourForm_leaverequest($formitem);
        
        // Processing leave request form
            $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
            $processClass = new FmcWhUser_Process();
            $processClass->workingHour_DayLeaveRequest($this->form, $request, $redirectUrl);
        
    }
    
    public function executeDay (sfWebRequest $request) {
        
        // Loading parameters
            $this->date = $request->getParameter('date');
        
        // Loading configuration
            $this->user = $this->getUser()->getGuardUser();
            $user_id = $this->user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        // Loading required classes
            $checkClass = new FmcWhUser_Check();
            $accessClass = new FmcWhUser_Access();
            $processClass = new FmcWhUser_Process();
        
        // Fetching day type
        
            $dayType = $checkClass->getDayType ($user_id, $this->date);
        
        // Checking day type
        
        if ( $dayType == 'empty' ) {
            
            // Setting template
                $this->setTemplate('newday');
            
            // Fetching leave usage for leave screen
                $this->leaveUsageCount = $accessClass->getLeaveUsage();
            
            // Preparing office entrance form
                $formitem = new WorkingHourDay();
                $formitem->setType("Enter");
                $formitem->setUser($this->user);
                $formitem->setDate($this->date);
                $this->form = new WorkingHourForm_enterday($formitem);
            
            // Processing form
                $redirectUrl = '@workingHourUser_day?date='.$this->date;
                $processClass->workingHour_DayEntrance($this->form, $request, $redirectUrl);
            
        } else {
            
            // Preparing day cancel url
            
                $this->cancelUrl = $this->getController()
                    ->genUrl('@workingHourUser_deleteday?date='.$this->date);
            
            if ($dayType == 'leave') {
             
                // Fetching leave info
                    $this->leaveRequest = $accessClass->getDayLeave($this->date);
                
                // Setting leave info template
                    $this->setTemplate('leaveinfo');
                
            } else {
                
                // Setting normal day template
                    $this->setTemplate('editday');
                
                // Fetching day entrance hourgetDayHours
                    $this->entranceHour = Doctrine::getTable('WorkingHourDay')
                        ->getDayHours($user_id, $this->date, "Enter");
                    
                // Fetching current items
                    $this->items = Doctrine::getTable('WorkingHour')
                        ->getByuseranddate($user_id, $this->date);
                
                // Preparing new item form
                    $this->item = new WorkingHour();
                    $this->item->setDate($this->date);
                    $this->item->setUser($this->user);
                    $lastTime = strtotime ($this->item->getNextHour($this->date, $user_id));
                    $this->item->setStart(date('H:i',$lastTime));
                    $this->item->setEnd(date('H:i',$lastTime + 1800));
                    $this->form = new WorkingHourForm_dayitemnew ($this->item);
                    
                // Processing form
                    
                    $redirectUrl = '@workingHourUser_day?date='.$this->date;
                    $processClass->workingHour_DayItems
                        ($this->form, $request, $redirectUrl, $this->items);
            }
            
        }
        
    }
    
}
