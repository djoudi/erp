<?php

abstract class Basewh_ProcessActions extends sfActions {
    
    
    public function executeApprove (sfWebRequest $request) {
        
        // Getting object
        
            $id = $request->getParameter('id');
            $object = Doctrine::getTable('WorkingHourLeave')->findOneById ($id);
            $this->forward404Unless ($object);
        
        // Approving request
            $user = $this->getUser()->getGuardUser();
            $object->setStatus ("Approved");
            $object->save();
        
        // Creating working Hours
            Doctrine::getTable('WorkingHour')->createLeave (
                $object["user_id"], 
                $object["from_Date"],
                $object["to_Date"]
            );
        
        // Redirecting
            $this->getUser()->setFlash('success', 'Leave request has been approved successfully.');
            
            $redirectUrl = $this->getController()->genUrl('@wh_process_leaverequests_process?id='.$id);
            $this->redirect($redirectUrl);
    }
    
    
    public function executeDeny (sfWebRequest $request) {
        
        // Getting object
        
            $id = $request->getParameter('id');
            $object = Doctrine::getTable('WorkingHourLeave')->findOneById ($id);
            $this->forward404Unless ($object);
        
        // Denying request
            $user = $this->getUser()->getGuardUser();
            $object->setStatus ("Denied");
            $object->save();
        
        // Redirecting
            $this->getUser()->setFlash('error', 'Leave request has been denied.');
            
            $redirectUrl = $this->getController()->genUrl('@wh_process_leaverequests_process?id='.$id);
            $this->redirect($redirectUrl);
    }
    
    
    
    public function executeProcess (sfWebRequest $request) {
        
        $id = $request->getParameter('id');
        
        $this->leave = Doctrine::getTable('WorkingHourLeave')->findOneById ($id);
        $this->forward404Unless ($this->leave);
        
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        $this->approveUrl = $this->getController()->genUrl('@wh_process_leaverequests_approve?id='.$id);
        $this->denyUrl = $this->getController()->genUrl('@wh_process_leaverequests_deny?id='.$id);
        
        $this->form = new form_wh_process_leave ($this->leave);
        
        $url = $request->getReferer();
        
        $process = new FmcWhUser_Process;
        $process->workingHour_DayLeaveRequest ($this->form, $request, $url);
        
    }
    
    
    
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
