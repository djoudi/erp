<?php

class workingHourLeaveComponents extends sfComponents
{
    
    public function executeNewRequest()
    {
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
    }
    
}
