<?php

class PluginWorkingHourDayTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    
    }
    
    public function getDayHours ($user_id, $date, $type) {
        
        $result = $this
            ->CreateQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('whd.type = ?', $type)
            ->fetchOne();
        return $result;
        
    }
    
    
    /* TODO: unite this function with function above */
    /*
    public function getEntranceForDate ($user_id, $date) {
      
        $result = Doctrine_Query::create()
            ->from ('WorkingHourDay')
            ->addWhere ('user_id = ?', $user_id)
            ->addWhere ('date = ?', $date)
            ->fetchOne();
      
      return $result;
    }
    */
}
