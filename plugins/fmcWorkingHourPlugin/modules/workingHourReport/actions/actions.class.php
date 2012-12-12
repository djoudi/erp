<?php

class workingHourReportActions extends sfActions
{
    public function executeDaily (sfWebRequest $request)
    {
        if ( ! ( $this->date = $request->getParameter('date') ) )
            $this->date = date("Y-m-d");
        
        $this->list = Doctrine::getTable ('sfGuardUser')
            ->createQuery ('u')
            ->innerJoin ('u.WorkingHourDay d')
            ->leftJoin ('d.WorkingHourRecords r')
            ->leftJoin ('d.LeaveRequest l')
            ->leftJoin ('l.LeaveType t')
            
            ->addWhere ('d.date = ?', $this->date)
            ->addWhere ('d.status <> ?', "Denied")
            
            
            
            ->orderBy ('r.start_Time, r.recordType ASC')
            
            ->execute();
    }
    
}

// day status de olsun
