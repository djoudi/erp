<?php

class PluginCostFormTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginCostForm');
    }    
    
    public static function ReportListEmployees ()
    {
        return Doctrine::getTable ('sfGuardUser')->getActive();
    }
    
    public static function ReportListProjects ()
    {
        return Doctrine::getTable ('Project')->getActive();
    }
    
    public static function getByUser( $userId )
    {
        $q = Doctrine_Query::create()
            ->from('CostForm cf')
            ->leftJoin('cf.CostFormItems cfi')
            ->where('cf.status <> ?', 'Draft')
            ->andWhere('cf.user_id = ?', $userId);
        
        return $q->execute();
    }
    
    public static function getById ( $id )
    {
        $q = Doctrine_Query::create()
            ->from('CostForm cf')
            ->leftJoin('cf.CostFormItems cfi')
            ->where('cf.id = ?', $id);
        
        return $q->fetchOne();
    }
    
    public static function getAll () {
        
        $q = Doctrine_Query::create()
            ->from('CostForm cf')
            ->where('cf.status <> ?', 'Draft');
        
        return $q->execute();
    }
    
}
