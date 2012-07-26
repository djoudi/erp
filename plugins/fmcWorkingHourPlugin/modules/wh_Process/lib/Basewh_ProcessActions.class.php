<?php

abstract class Basewh_ProcessActions extends sfActions {
    
    public function executeLeaverequests (sfWebRequest $request) {
        
        // Fetching config
        
            $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
            $user = $this->getUser()->getGuardUser();
        
        // Setting variables
        
            $resultlimit = 100;
        
        // Preparing filter query
        
            $query = Doctrine::getTable ('WorkingHourLeave')
                ->PrepareFilterAllRequests ($resultlimit);
        
        // Preparing filter
        
            $filterClass = new FmcFilter('filter_wh_process_leave');
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
    
}
