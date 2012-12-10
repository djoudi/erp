<?php

class workingHourLeaveActions extends sfActions
{
    
    public function executeNewRequest (sfWebRequest $request)
    {
        whDayInfo::routeDay ($this->date = $request->getParameter ('date'), "New");
        
        $type_id = $request->getParameter('type_id');
        
        
        if (!whLeaveUser::hasEnoughLimit ($type_id))
        {
            $this->getUser()->setFlash ('error', "You don't have enough limits for this leave type!");
            whDayInfo::routeDay ($this->date);
        }
        
        $this->leaveType = Doctrine::getTable ('LeaveType')->findOneById ($type_id);
        
        $this->forward404Unless ($this->leaveType);
        
        
        $this->date = $request->getParameter ('date');
        // set def date
        
        
        //forms 
        
        
    }
    
}
