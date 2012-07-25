<?php

class PluginWorkingHourTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHour');
        
    }
    
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
    
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'start ASC';
        
    }
    
    public function getByuseranddate ($user_id, $date) {
        
        $result = $this->CreateQuery ('wh')
            ->addWhere ('wh.user_id = ?', $user_id)
            ->addWhere ('wh.date = ?', $date)
            ->orderBy ('wh.start ASC')
            ->execute();
        
        return $result;
    }
    
    public function getLastItems ($user_id, $count = 5) {
        
        $result = $this->CreateQuery ('wh')
            ->addWhere ('wh.user_id = ?', $user_id)
            ->addWhere ('wh.created_by = ?', $user_id)
            ->orderBy ('wh.updated_at DESC')
            ->limit ($count)
            ->execute();
        
        return $result;
    }
    
    
    
    public function cancelItems ($user_id, $date) {
        
        $items = $this->CreateQuery ('wh')
            ->addWhere ('wh.user_id = ?', $user_id)
            ->addWhere ('wh.date = ?', $date)
            ->execute();
        if (count($items)) {
            $items->delete();
        }
        
    }
    
    
}
