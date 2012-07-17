<?php

abstract class PluginsfGuardGroupTable extends Doctrine_Table {
    
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
    
        parent::__construct($name, $conn, $initDefinition);
        #$this->_options['orderBy'] = 'name ASC';
        
    }
    
}
