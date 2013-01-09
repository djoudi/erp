<?php

class whLeaveUser
{
    
    public static function countUsedLimit ($type_id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.employee_id = ?', $employee_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status = ?', 'Accepted');
        return $q->count();
    }
    
    public static function countUsedReservedLimit ($type_id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $q = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.employee_id = ?', $employee_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status <> ?', 'Denied');

        return $q->count();
    }
    
    
    public static function countAvailableLimit ($type_id, $employee_id = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $limit = Doctrine::getTable ('LeaveRequestLimit')->getForUserType ($employee_id, $type_id);
        
        if ($limit)
            $result = $limit['leaveLimit'];
        else
        {
            $type = Doctrine::getTable ('LeaveType')->findOneById ($type_id);
            $result = $type['default_Limit'];
        }
        
        return $result;
    }
    
    public static function hasEnoughLimit ($type_id, $employee_id = NULL)
    {
        $used = whLeaveUser::countUsedReservedLimit ($type_id, $employee_id);
        $available = whLeaveUser::countAvailableLimit ($type_id, $employee_id);
        return $available > $used;
    }
    
}
