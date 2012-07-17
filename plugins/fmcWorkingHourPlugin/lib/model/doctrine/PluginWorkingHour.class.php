<?php

abstract class PluginWorkingHour extends BaseWorkingHour {
    
    public function getTimeDifference() {
        
        $start = strtotime ($this->getStart());
        $end = strtotime ($this->getEnd());
        
        $minute = ( ($end-$start) / 60 ) % 60;
        $hour = ( ( ($end-$start) / 60 ) - $minute ) / 60;
        
        return $hour."h ".$minute."m";
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
