<?php

class PluginWorkingHourDayTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    
    }
    
    public function getDayHours ($user_id, $date, $type) {
        
        $result = $this->CreateQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('whd.type = ?', $type)
            ->fetchOne();
        return $result;
    }
    
    
    
    public function deleteIo ($user_id, $date) {
        
        $entranceExit = $this->CreateQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->execute();
        if (count($entranceExit)) {
            $entranceExit->delete();
        }
        
    }
    
    
}
