<?php

class whQuery
{
    
    public static function prepareReportDaily ($date)
    {
        $q = Doctrine::getTable ('sfGuardUser')
            ->createQuery ('u')
            ->innerJoin ('u.WorkingHourDay d')
            ->leftJoin ('d.WorkingHourRecords r')
            ->leftJoin ('d.LeaveRequest l')
            ->leftJoin ('l.LeaveType t')
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status <> ?', "Denied")
            ->orderBy ('u.first_name, r.start_Time, r.recordType ASC');
        
        return $q->execute();
    }
    
}
