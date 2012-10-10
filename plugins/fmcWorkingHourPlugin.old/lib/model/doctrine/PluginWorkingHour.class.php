<?php

abstract class PluginWorkingHour extends BaseWorkingHour {
    
    public function getTimeDifference() {
        
        $access = new FmcWhUser_Access;
        
        return $access->calcTimeDif ($this->getStart(), $this->getEnd());
    }
    
    public function getNexthour($date, $user_id) {
        
        $item = Doctrine::getTable('WorkingHour')
            ->createQuery ('wh')
            ->addWhere ('wh.date = ?', $date)
            ->addWhere ('wh.user_id = ?', $user_id)
            ->orderBy ('wh.end DESC')
            ->fetchOne () ;
        
        if ($item) {
            
            $result = $item->getEnd();
            
        } else {
            
            $result = Doctrine::getTable('WorkingHourDay')->getDayHours ($user_id, $date, "Enter")->getTime();
        }
        
        return $result;
        
    }
    
}
