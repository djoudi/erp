<?php

class PluginWorkingHourLeaveTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHourLeave');
        
    }
    
    public function getActiveByUserAndDate ($user_id, $date) {
        
        $result = $this->CreateQuery ('whl')
            ->addWhere ('whl.user_id = ?', $user_id)
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status <> ?', 'Denied')
            ->addWhere ('whl.status <> ?', 'Cancelled')
            ->execute();
        return $result;
    }
    
}
