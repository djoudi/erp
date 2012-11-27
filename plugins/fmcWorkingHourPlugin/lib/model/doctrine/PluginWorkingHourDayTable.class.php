<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    
    public function getDraftForUserDate ($user_id, $date)
    {
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status = ?', 'Draft');
        return $q->fetchOne();
    }
    
    
    /* DELETING MY CLASSES
    public function getMyDraftForDate ($date)
    {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        return $this->getDraftForUserDate ($user['id'], $date);
    }
    */
    
    
    /* DELETING MY CLASSES
    public function getMyActiveForDate ($date)
    {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        return $this->getActiveForUserDate ($user['id'], $date);
    }
    */
    
    
    public function getTypeForUserDate ($user_id, $date)
    {
        if ( $whday = $this->getActiveForUserDate ($user_id, $date) )
        {
            if ($whday['leave_id']) $status = "Leave";
            else $status = "Work";
        }
        else
        {
            $status = "Empty";
        }
        return $status;
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
