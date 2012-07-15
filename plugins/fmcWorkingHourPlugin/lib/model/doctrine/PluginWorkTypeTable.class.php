<?php

class PluginWorkTypeTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkType');
        
    }
  
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
        
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'title ASC';
        
    }
  
    public function getOrdered() {
        
        return $this->CreateQuery ('worktype')
            ->orderBy ('worktype.code ASC')
            ->execute();
        
    }
    
}
