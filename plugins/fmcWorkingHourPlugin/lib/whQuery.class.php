<?php

class whQuery
{
    
    public static function prepareLeaveApproveQuery ($resultLimit)
    {
        $q = Doctrine_Query::create()
            ->from ('LeaveRequest l')
            ->leftJoin ('l.Employee e')
            ->leftJoin ('l.LeaveType t')
            ->innerJoin ('l.WorkingHourDay d')
            ->addWhere ('l.status = ?', "Pending")
            ->limit ($resultLimit);
        
        return $q;
    }
    
    
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
    
    public static function prepareReportEmployee ($from, $to, $emp)
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->leftJoin ('r.Day d')
            ->leftJoin ('r.Project p')
            ->leftJoin ('r.WorkType wt')
            ->addWhere ('d.date > ?', $from)
            ->addWhere ('d.date < ?', $to)
            ->addWhere ('d.employee_id = ?', $emp)
            ->addWhere ('d.status = ?', "Accepted")
            ->addWhere ('r.recordType = ?', "Work")
            ->orderBy ('d.DATE ASC, r.start_Time ASC');
            
        return $q->execute();
    }
    
    public static function prepareReportProject ($from, $to, $proj)
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->leftJoin ('r.Day d')
            ->leftJoin ('r.Project p')
            ->leftJoin ('r.WorkType wt')
            ->addWhere ('d.date > ?', $from)
            ->addWhere ('d.date < ?', $to)
            ->addWhere ('d.status = ?', "Accepted")
            ->addWhere ('r.project_id = ?', $proj)
            ->addWhere ('r.recordType = ?', "Work")
            ->orderBy ('d.DATE ASC, r.start_Time ASC');
            
        return $q->execute();
    }
    
}
