<?php

abstract class BaseworkingHourUserActions extends sfActions {
    
    
    /* #################################################################################### */
    
    
    public function executeDeleteitem (sfWebRequest $request) {
        
        $id = $request->getParameter('id');
        $item = Doctrine::getTable ('WorkingHour')->findOneById ($id);
        $this->forward404Unless ($item);
        
        $item->delete();
        
        $url = $url = $request->getReferer();
        $this->redirect ($url);
    }
    
    
    
    public function executeOfficeexit (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        $user = $this->getUser()->getGuardUser();
        $url = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
        
        $accessClass = new FmcWhUser_Access();
        $dayType = $accessClass->getDayType ($user["id"], $this->date);
        
        if ( $dayType != "work" ) {
            
            $this->getUser()->setFlash("error", $msg);
            $this->redirect ($url);
        }
        
        else {
            
            if ( $object = $user->getExitFor($this->date, "object") ) {
                
            } else {
                
                $object = new WorkingHourDay();
                $object->setUser($user);
                $object->setType("Exit");
                $object->setDate($this->date);
            }
            
            $this->form = new form_wh_exitday ($object);
            
            $process = new FmcWhUser_Process();
            $process->wh_user_dayexit($this->form, $request, $url);
        }
        
    }
    
    
    /* #################################################################################### */
    
    
    public function executeMyhome (sfWebRequest $request) {
        
        // Preparing variables
        
            $today = date ( "Y-m-d", mktime(0,0,0,date("m"),date("d"),date("Y")) );
            $this->todayUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$today);
        
        // Loading configuration
        
            $user = $this->getUser()->getGuardUser();
            $user_id = $user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
            
        // Getting day type
        
            $accessClass = new FmcWhUser_Access();
            $this->dayType = $accessClass->getDayType ($user_id, $today);
        
        // Checking day type
        
            if ($this->dayType == "leave") {
                
                $this->leaveRequest = Doctrine::getTable ('WorkingHourLeave')
                    ->getActiveByUserAndDate ($user_id, $today);
                
            } else if ($this->dayType == "work") {
                
                $this->entranceHour = Doctrine::getTable('WorkingHourDay')
                    ->getDayHours($user_id, $today, "Enter");
                
                $this->exitHour = Doctrine::getTable('WorkingHourDay')
                    ->getDayHours($user_id, $today, "Exit");
                    
                $this->items = Doctrine::getTable('WorkingHour')
                    ->getByuseranddate($user_id, $today);
                
            }
        
    }
    
    /* #################################################################################### */
    
    
    public function executeMyleaverequests (sfWebRequest $request) {
        
        // Fetching config
        
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
            $user = $this->getUser()->getGuardUser();
        
        // Setting variables
        
            $resultlimit = 100;
        
        // Preparing filter query
        
            $query = Doctrine::getTable ('WorkingHourLeave')
                ->PrepareFilterMyRequests ($user->getId(), $resultlimit);
        
        // Preparing filter
        
            $filterClass = new FmcFilter('WorkingHourFilter_myleave');
            $this->myLeaveRequests = $filterClass
                ->initFilterForm ($request, $query)
                ->execute()
                ->toArray();
        
        // Filtering variables
        
            if ($request->hasParameter('_reset')) $filterClass->resetForm ();
            $this->filter = $filterClass->getFilter();
            $this->filtered = $filterClass->getFiltered();
        
        // Checking result overload
        
            $this->resultslimited = count($this->myLeaveRequests) == $resultlimit ? true : false;
            
    }
    
    
    /* #################################################################################### */
    
    
    public function executeDeleteday (sfWebRequest $request) {
        
        // Fetching variables
            $date = $request->getParameter ('date');
            $user = $this->getUser()->getGuardUser();
        
        // Deleting day
            $accessClass = new FmcWhUser_Access();
            $accessClass->deleteDay ($user->getId(), $date);
        
        // Forwarding
            $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$date);
            $this->redirect ($redirectUrl);
        
    }
    
    
    /* #################################################################################### */
    
    
    public function executeLeaverequest (sfWebRequest $request) {
        
        // Fetching parameters
        
            $this->date = $request->getParameter('date');
            $this->type = $request->getParameter('type');
        
        // Loading configuration
        
            $user = $this->getUser()->getGuardUser();
            $user_id = $user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        // Loading check class
        
            $accessClass = new FmcWhUser_Access();
            
        // Checking if day is empty and available
            
            $dayType = $accessClass->getDayType ($user_id, $this->date);
            
            if ( $dayType != "empty" ) {
        
                $this->getUser()->setFlash("error", "Day is not empty.");
                
                $redirectUrl = $this->getController()->genUrl('@workingHourUser_day?date='.$this->date);
                $this->redirect ($redirectUrl);
            }
        
        // Checking if user has enough limits
            
            $hasLimit =  Doctrine::getTable ('WorkingHourLeave')
                ->hasLimit ($user, $this->type);
            
            if ( ! $hasLimit ) {
                
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
    
    
    /* #################################################################################### */
    
    
    public function executeDay (sfWebRequest $request) {
        
        // Loading parameters
            $this->date = $request->getParameter('date');
        
        // Loading configuration
            $this->user = $this->getUser()->getGuardUser();
            $user_id = $this->user->getId();
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        // Loading required classes
            $accessClass = new FmcWhUser_Access();
            $processClass = new FmcWhUser_Process();
        
        // Fetching day type
        
            $dayType = $accessClass->getDayType ($user_id, $this->date);
        
        // Checking day type
        
        if ( $dayType == 'empty' ) {
            
            // Setting template
            
                $this->setTemplate('newday');
            
            // Fetching leave usage for leave screen
            
                $this->leaveUsageCount = Doctrine::getTable ('WorkingHourLeave')
                    ->getAllLeaveUsageForUser ($user_id);
            
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
                    $this->leaveRequest = Doctrine::getTable ('WorkingHourLeave')
                        ->getActiveByUserAndDate ($user_id, $this->date);
                    
                // Setting leave info template
                    $this->setTemplate('leaveinfo');
                
            } else {
                
                $this->exitUrl = $this->getController()->genUrl('@wh_user_officeexit?date='.$this->date);
                
                // Setting normal day template
                    $this->setTemplate('editday');
                
                // Fetching day entrance hourgetDayHours
                    $this->entranceHour = Doctrine::getTable('WorkingHourDay')
                        ->getDayHours($user_id, $this->date, "Enter");
                    $this->exitHour = Doctrine::getTable('WorkingHourDay')
                    ->getDayHours($user_id, $this->date, "Exit");
                    
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
    
    
    /* #################################################################################### */
    
    
}
