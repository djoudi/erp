<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    public function getMyActiveForDate ($date)
    {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        return $this->getActiveForUserDate ($user['id'], $date);
    }
    
    public function getActiveForUserDate ($user_id, $date)
    {
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status <> ?', 'Denied');
        return $q->fetchOne();
    }
    
    public function getUsedLeaveCount ($type_id, $user_id)
    {
        $q = $this->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.user_id = ?', $user_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status = ?', 'Accepted');
        return $q->count();
    }
}
