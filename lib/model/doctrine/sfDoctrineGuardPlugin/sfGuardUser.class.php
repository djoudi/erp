<?php

class sfGuardUser extends PluginsfGuardUser {
    
    
    /* ---------------------------------------------------------------*/
    
    
    public function getDayStatusFor ($date) {
        
        $accessClass = new FmcWhUser_Access;
        
        return $accessClass->getDayType($this->getId(), $date);
    }
    
    
    /* ---------------------------------------------------------------*/
    
    
    public function getActiveHours ($date) {
        
        $hours = Doctrine::getTable ('WorkingHour')
            ->createQuery ('wh')
            ->addWhere ('wh.user_id = ?', $this->getId())
            ->addWhere ('wh.date = ?', $date)
            ->execute();
        
        $totalWorked = 0;
        
        foreach ($hours as $hour) {
            
            $end = strtotime ($hour["end"]);
            $start = strtotime ($hour["start"]);
            $totalWorked += $end - $start;
        }
        
        $minute = ( ($totalWorked) / 60 ) % 60;
        $hour = ( ( ($totalWorked) / 60 ) - $minute ) / 60;
        
        return $hour."h ".$minute."m";
    }
    
        
    public function getLeave ($date) {
        
        $leave = Doctrine::getTable ('WorkingHourLeave')
            ->getActiveByUserAndDate ($this->getId(), $date);
        return $leave;
    }
    
    public function getEntranceFor ($date) {
        
        $entrance = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($this->getId(), $date, 'Enter');
        return $entrance["time"];
        
    }
    
    public function getOfficeDif ($date) {
        
        $entrance = $this->getEntranceFor ($date);
        $exit = $this->getExitFor ($date);
        
        $access = new FmcWhUser_Access;
        return $access->calcTimeDif ($entrance, $exit);
        
    }
    
    public function getExitFor ($date, $type="value") {
        
        $exit = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($this->getId(), $date, 'Exit');
            
        if ($type=="object")
            $result = $exit;
        else
            $result = $exit["time"];
        
        return $result;
    }
    
}
