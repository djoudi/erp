<?php

class PluginWorkTypeTable extends Doctrine_Table {
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkType');
        
    }
  
    public function __construct($name, Doctrine_Connection $conn, $initDefinition = false) {
        
        parent::__construct($name, $conn, $initDefinition);
        $this->_options['orderBy'] = 'code ASC';
        
    }
    
    public function getOrderedUserRights() {
        
        $group_id = sfContext::getInstance()->getUser()->getGuardUser()->getGroupId();
        
        $query = $this->CreateQuery ('wt')
            ->leftJoin ('wt.Groups dpt')
            ->addWhere ('dpt.id = ?', $group_id)
            ->orderBy ('wt.code ASC')
            ->execute();
        
        return $query;
        
    }
    
}
