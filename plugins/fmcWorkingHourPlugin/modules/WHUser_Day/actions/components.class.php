<?php

class WHUser_DayComponents extends sfComponents
{
    
    public function executeNewLeaveRequest()
    {
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
    }
    
    public function executeNewDay()
    {
        
    }
}
