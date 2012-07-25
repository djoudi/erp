<?php

class FmcWhUser_Access {
    
    
    /* ###################################################################### */
    
    
    public function deleteDay ($user_id, $date) {
        
        $leave = Doctrine::getTable ('WorkingHourLeave')
            ->cancelRequest ($user_id, $date);
        
        $items = Doctrine::getTable ('WorkingHour')
            ->cancelItems ($user_id, $date);
        
        $officeIo = Doctrine::getTable ('WorkingHourDay')
            ->deleteIo ($user_id, $date);
        
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
