<?php

class workingHourApproveDayActions extends sfActions
{
    
    public function executeDetails (sfWebRequest $request)
    {
        $this->day = Doctrine::getTable('WorkingHourDay')->findOneById ($request->getParameter('id'));
        
        $this->forward404Unless ($this->day);
    }
    
    
    public function executeApprove (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $day = Doctrine::getTable('WorkingHourDay')->getWithIdAndStatus ($id, "Pending");
        
        $this->forward404Unless ($day);
        
        $day->setStatus ('Accepted');
        
        $day->save();
        
        $this->getUser()->setFlash ('notice', 'Day approved successfuly.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeDeny (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $day = Doctrine::getTable('WorkingHourDay')->getWithIdAndStatus ($id, "Pending");
        
        $this->forward404Unless ($day);
        
        $day->setStatus ('Denied');
        
        $day->save();
        
        $this->getUser()->setFlash ('notice', 'Day denied successfuly.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeList (sfWebRequest $request)
    {
        $this->resultLimit = 100;
        
        // Edit these variables
    
        $_q = Doctrine_Query::create()
            ->from ('WorkingHourDay w')
            ->leftJoin ('w.Employee e')
            ->leftJoin ('w.LeaveRequest l')
            ->innerJoin ('w.WorkingHourRecords r')
            ->addWhere ('w.leave_id IS NULL')
            ->addWhere ('w.status = ?', "Pending")
            ->orderBy ('r.start_Time, recordType ASC')
            ->limit ($this->resultLimit);
        
        $filterClass = new FmcFilter('whFilter_dayRequest');
    
        $this->items = $filterClass->initFilterForm($request, $_q)->execute()->toArray();
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
    
}
