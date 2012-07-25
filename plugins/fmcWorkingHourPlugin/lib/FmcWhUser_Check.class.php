<?php

class FmcWhUser_Check {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }
    
    
    /* ###################################################################### */
    
    
    public function hasLeaveLimit ($type) {
        
        $accessClass = new FmcWhUser_Access();
        
        $usage = $accessClass->getLeaveUsageForType($type);
        
        $limitTemp = "get".$type."Limit";
        $userLimit = $this->user->getGuardUser()->$limitTemp();
        
        return $userLimit > $usage;
        
    }
    
    
    /* ###################################################################### */
    
    
    public function getDayType ($user_id, $date) {
        
        $entranceRecords = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($user_id, $date, 'Enter');
        
        if ($entranceRecords) $type = 'work';
        
        else {
            
            $leaveRecords = Doctrine::getTable('WorkingHourLeave')
                ->getActiveByUserAndDate ($user_id, $date);
            
            if (count($leaveRecords)) $type = 'leave';
        
            else $type = 'empty';
        
        }
        
        return $type;
        
    }
    
    
    /* ###################################################################### */
    
    
}
