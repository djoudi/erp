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
    
    public function getExitFor ($date) {
        
        $entrance = Doctrine::getTable('WorkingHourDay')
            ->getDayHours ($this->getId(), $date, 'Exit');
        return $entrance["time"];
        
    }
    
}
