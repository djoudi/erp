<?php

class PluginWorkingHourTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHour');
        
    }
    
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
    
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'start ASC';
        
    }
    
    public function createLeave ($user_id, $date) {
        
        $object = new WorkingHour();
        $object->set('user_id', $user_id);
        $object->set('date', $date);
        $object->set('project_id', 38); //Fmconsulting Admin
        $object->set('worktype_id', 1); //A0 general admin works
        $object->set('start', '09:00');
        $object->set('end', '18:00');
        $object->set('created_by', $user_id);
        $object->save();
        
    }
    
    
    
    public function getByuseranddate ($user_id, $date) {
        
        $result = $this->CreateQuery ('wh')
            ->addWhere ('wh.user_id = ?', $user_id)
            ->addWhere ('wh.date = ?', $date)
            ->orderBy ('wh.start ASC')
            ->execute();
        
        return $result;
    }
    
    #$result = Doctrine::getTable ('WorkingHour')->getLastItem ($user_id, $date);
    
    public function getLastItem ($user_id, $date) {
        
        $result = $this->CreateQuery ('wh')
            ->addWhere ('wh.user_id = ?', $user_id)
            ->addWhere ('wh.date = ?', $date)
            ->orderBy ('wh.end DESC')
            ->fetchOne();
        
        return $result["end"];
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
