<?php

class PluginWorkingHourWorkTypeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourWorkType');
    }
    
    public function getUserList ($employee_id = NULL, $group_id = NULL)
    {
        if (!$employee_id)
        {
            $user = sfContext::getInstance()->getUser()->getGuardUser();
            $employee_id = $user['id'];
            $group_id = $user['group_id'];
        }        
        $q = $this->createQuery ('wt')
            ->leftJoin ('wt.WorkingHourWorkTypeUser wtu')
            ->leftJoin ('wtu.Employee e')
            ->leftJoin ('wt.WorkingHourWorkTypeGroup wtg')
            ->leftJoin ('wtg.Department d')
            ->where ('e.id = ?', $employee_id)
            ->orWhere ('d.id = ?', $group_id);
        return $q->execute();
    }
    
}
