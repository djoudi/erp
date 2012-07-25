<?php

class FmcWhUser_Check {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
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
    
    
    /* ###################################################################### */
    
    
}
