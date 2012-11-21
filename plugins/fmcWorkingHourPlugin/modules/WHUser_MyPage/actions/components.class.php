<?php

class WHUser_MyPageComponents extends sfComponents
{
    public function executeNewLeaveRequest()
    {
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll();
    }
}
