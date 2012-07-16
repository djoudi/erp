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
    
    public function getOrderedUserRights() {
        
        $group_id = sfContext::getInstance()->getUser()->getGuardUser()->getGroupId();
        $query = $this->CreateQuery ('worktype')
            ->leftJoin ('worktype.Groups dpt')
            ->addWhere ('dpt.id = ?', $group_id)
            ->orderBy ('worktype.code ASC')
            ->execute();
        return $query;
        
    }
    
}
