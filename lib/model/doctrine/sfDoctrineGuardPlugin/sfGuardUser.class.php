<?php

class sfGuardUser extends PluginsfGuardUser {
    
    public function getDayStatusFor ($date) {
        
        $accessClass = new FmcWhUser_Access;
        
        return $accessClass->getDayType($this->getId(), $date);
    }
    
    public function getEntranceFor ($date) {
        
        $entrance = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($this->getId(), $date, 'Enter');
        return $entrance["time"];
        
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
