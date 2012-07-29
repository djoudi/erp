<?php

class sfGuardUserTable extends PluginsfGuardUserTable {
    
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('sfGuardUser');
        
    }
    
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
        
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'first_name, last_name ASC';
        
    }
    
    public function all_wh_reports_oe () {
        
        $objects = $this->createQuery('u')
            ->leftJoin ('u.Department d')
            ->addWhere ('u.is_active = ?', true)
            ->addWhere ('u.username <> ?', 'yasin')
            ->orderBy('first_name ASC')
            ->execute();
            
        return $objects;
    }
        
}
