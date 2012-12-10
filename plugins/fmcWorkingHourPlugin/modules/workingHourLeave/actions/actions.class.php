<?php

class workingHourLeaveActions extends sfActions
{
    
    public function executeNewRequest (sfWebRequest $request)
    {
        if ($this->date = $request->getParameter ('date'))
        {
            whDayInfo::routeDay ($this->date, "New");
        }
        else $this->date = date ("Y-m-d");
        
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
        
        $leaveObject->setUserId ($this->getUser()->getGuardUser()->getId());
        $leaveObject->setTypeId ($type_id);
        $leaveObject->setStatus ('Draft');
        $leaveObject->setStartDate ($this->date);
        $leaveObject->setEndDate ($this->date);
        
        if ($this->leaveType['has_Report'])
            $this->form = new whForm_newLeaveWReport ($leaveObject);
        else
            $this->form = new whForm_newLeaveWoReport ($leaveObject);
        
        
        // Processing Forms
        
    }
    
}
