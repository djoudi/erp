<?php

class whLeaveUser
{
    
    public static function countUsedLimit ($type_id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.user_id = ?', $user_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status = ?', 'Accepted');
        return $q->count();
    }
    
    public static function countUsedReservedLimit ($type_id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.user_id = ?', $user_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status <> ?', 'Denied');

        return $q->count();
    }
    
    
    public static function countAvailableLimit ($type_id, $user_id = NULL)
    {
        if (!$user_id) $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $limit = Doctrine::getTable ('LeaveRequestLimit')->getForUserType ($user_id, $type_id);
        
        if ($limit)
            $result = $limit['leaveLimit'];
        else
        {
            $type = Doctrine::getTable ('LeaveType')->findOneById ($type_id);
            $result = $type['default_Limit'];
        }
        
        return $result;
    }
    
    public static function hasEnoughLimit ($type_id, $user_id = NULL)
    {
        $used = whLeaveUser::countUsedLimit ($type_id, $user_id);
        $available = whLeaveUser::countAvailableLimit ($type_id, $user_id);
        return $available > $used;
    }
    
}
