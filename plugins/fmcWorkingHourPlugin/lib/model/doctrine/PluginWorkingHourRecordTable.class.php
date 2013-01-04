<?php

class PluginWorkingHourRecordTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourRecord');
    }
    
    public function deleteDraftItem ($date, $id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $object = $this->createQuery ('r')
            ->leftJoin ('r.Day d')
            ->addWhere ('r.id = ?', $id)
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.employee_id = ?', $employee_id)
            ->addWhere ('d.status = ?', "Draft")
            ->fetchOne();
        
        if ($object) $object->delete();
    }
    
}
