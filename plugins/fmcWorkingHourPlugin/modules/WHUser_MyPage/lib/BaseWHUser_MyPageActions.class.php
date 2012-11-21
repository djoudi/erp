<?php
/*
    
        
    public function executeLeaverequestselect (sfWebRequest $request)
    {
        // Get leave types
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
        
        // @TODO - can do this with component?
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
    
    
    
    
    
}
*/
