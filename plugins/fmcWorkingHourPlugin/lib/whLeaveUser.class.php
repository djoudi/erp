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
    
    
    
    public static function countUsedReservedLimit ($type_id, $employee_id = NULL, $date = NULL)
    {
        if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $query = Doctrine_Query::create()
            ->select ('sum(day_Count)')
            ->from ('LeaveRequest lr')
            ->addWhere ('lr.employee_id = ?', $employee_id)
            ->addWhere ('lr.type_id = ?', $type_id);
        
        $year = (substr($date,0,4));
        
        $leaveType = Doctrine::getTable("LeaveType")->findOneById ($type_id);
        
        if ($leaveType["yearly_Limit"])
        {
            $query
                ->addWhere ("lr.start_Date > ?", "{$year}-01-01")
                ->addWhere ("lr.end_Date < ?", "{$year}-12-31");
        }
        
        $sum = $query->fetchOne();
        
        return $sum["sum"] ? $sum["sum"] : 0;
    }
    
    
    
    public static function countAvailableLimit ($type_id, $employee_id = NULL)
    {
        $leaveType = Doctrine::getTable("LeaveType")->findOneById ($type_id);
        
        if ($yearlyLimit = $leaveType["yearly_Limit"])
        {
            $limit = $yearlyLimit;
        }
        else
        {
            if (!$employee_id) $employee_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
            
            $employee = Doctrine::getTable("sfGuardUser")->findOneById($employee_id);
            
            $limit = $employee->getLeaveLimitSum ($type_id);
        }
        
        return $limit;
    }
    
    
    
    public static function hasEnoughLimit ($type_id, $employee_id = NULL)
    {
        $used = whLeaveUser::countUsedReservedLimit ($type_id, $employee_id);
        
        $available = whLeaveUser::countAvailableLimit ($type_id, $employee_id);
        
        return $available > $used;
    }
    
}
