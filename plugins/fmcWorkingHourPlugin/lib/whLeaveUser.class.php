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
        
        $employee = Doctrine::getTable("sfGuardUser")->findOneById($employee_id);
        
        $limit = $employee->getLeaveLimitSum ($type_id);
        
        return $limit;
    }
    
    
    
    public static function hasEnoughLimit ($type_id, $employee_id = NULL)
    {
        $used = whLeaveUser::countUsedReservedLimit ($type_id, $employee_id);
        
        $available = whLeaveUser::countAvailableLimit ($type_id, $employee_id);
        
        return $available > $used;
    }
    
}
