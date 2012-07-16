<?php

class PluginCostFormTable extends Doctrine_Table {
  
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginCostForm');
        
    }
    
    public static function ReportListEmployees () {
    
        $result = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->orderBy('u.email_address ASC')
            ->execute();
        return $result;
        
    }
    
    public static function ReportListProjects () {
    
        $result = Doctrine_Query::create()
            ->from('Project')
            ->orderBy('code ASC')
            ->execute();
        return $result;
        
    }
    
    public static function getByUser( $userId ) {
        
        $result = Doctrine_Query::create()
            ->from('CostForm cf')
            ->leftJoin('cf.CostFormItems cfi')
            ->where('cf.status <> ?', 'Draft')
            ->andWhere('cf.user_id = ?', $userId)
            ->execute();
        return $result;
    }
    
    public static function getById ( $id ) {
    
        $result = Doctrine_Query::create()
            ->from('CostForm cf')
            ->leftJoin('cf.CostFormItems cfi')
            ->where('cf.id = ?', $id)
            ->fetchOne();
        return $result;
        
    }
    
    public static function getAll () {
        
        $result = Doctrine_Query::create()
            ->from('CostForm cf')
            ->where('cf.status <> ?', 'Draft')
            ->execute();
        return $result;
        
    }
    
}
