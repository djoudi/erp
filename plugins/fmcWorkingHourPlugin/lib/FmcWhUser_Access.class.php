<?php

class FmcWhUser_Access {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser()->getGuardUser();
        $this->user_id = $this->user->getId();
        
    }
    
    
    /* ###################################################################### */
    
    
    public function getLeaveUsage () {
        
        $leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $LeaveUsageCount = array();
        
        foreach ($leaveStatus as $key=>$label) {
            
            $LeaveUsageCount[$key] = Doctrine::getTable ('WorkingHourLeave')
                ->getUsedLeaveCount ($this->user_id, $key);
        }
        
        return $LeaveUsageCount;
        
    }
    
    
    /* ###################################################################### */
    
    
    public function deleteDay ($date) {
        
        $leave = Doctrine::getTable ('WorkingHourLeave')
            ->cancelRequest ($this->user_id, $date);
        
        $items = Doctrine::getTable ('WorkingHour')
            ->cancelItems ($this->user_id, $date);
        
        $officeIo = Doctrine::getTable ('WorkingHourDay')
            ->deleteIo ($this->user_id, $date);
        
    }
        
    
    /* ###################################################################### */
    
    
    public function getDayType ($user_id, $date) {
        
        $entranceRecords = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($user_id, $date, 'Enter');
        
        if ($entranceRecords) $type = 'work';
        
        else {
            
            $leaveRecords = Doctrine::getTable('WorkingHourLeave')
                ->getActiveByUserAndDate ($user_id, $date);
            
            if ($leaveRecords) $type = 'leave';
        
            else $type = 'empty';
        
        }
        
        return $type;
        
    }
    
    
}
