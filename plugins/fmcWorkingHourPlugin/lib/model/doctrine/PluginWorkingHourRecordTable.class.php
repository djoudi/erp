<?php

class PluginWorkingHourRecordTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourRecord');
    }
    
    public function deleteDraftItem ($date, $id, $employee_id = NULL, $admin = false)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = $this->createQuery ('r')
            ->leftJoin ('r.Day d')
            ->addWhere ('r.id = ?', $id)
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status = ?', "Draft");
        
        if (!$admin) $q->addWhere ('d.employee_id = ?', $employee_id);
        
        $object = $q->fetchOne();
        
        if ($object) $object->delete();
    }
    
    public function deleteDraftItemAdmin ($date, $id)
    {
        $object = $this->createQuery ('r')
            ->leftJoin ('r.Day d')
            ->addWhere ('r.id = ?', $id)
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status = ?', "Draft")
            ->fetchOne();
        
        if ($object) $object->delete();
    }
    
}
