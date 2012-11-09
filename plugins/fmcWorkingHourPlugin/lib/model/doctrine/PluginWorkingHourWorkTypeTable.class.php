<?php

class PluginWorkingHourWorkTypeTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourWorkType');
    }
    
    
    public function getListForUser ($user_id, $group_id)
    {
        $q = $this->createQuery ('wt')
            ->leftJoin ('wt.WorkingHourWorkTypeUser wtu')
            ->leftJoin ('wtu.Employee e')
            ->leftJoin ('wt.WorkingHourWorkTypeGroup wtg')
            ->leftJoin ('wtg.Department d')
            ->where ('e.id = ?', $user_id)
            ->orWhere ('d.id = ?', $group_id);
        return $q->execute();
    }
    
    
    public function getCurrentUserList()
    {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        return $this->getListForUser ($user['id'], $user['group_id']);
    }
    
}
