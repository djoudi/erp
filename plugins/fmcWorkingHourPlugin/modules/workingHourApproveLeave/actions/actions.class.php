<?php

class workingHourApproveLeaveActions extends sfActions
{
    
    private function updateStatus ($item, $status)
    {
        $item->setStatus ($status);
        $item->save();
        
        foreach ($item->getWorkingHourDay() as $day)
        {
            $day->setStatus ($status);
            $day->save();
            
            if ($status == "Accepted")
            {
                $work = new WorkingHourRecord();
                $work->setDay ($day);
                $work->setRecordType ("Work");
                $work->setStartTime ("09:00:00");
                $work->setEndTime ("18:00:00");
                $work->setProjectId (38); //fmconadmin
                $work->setWorkTypeId (40); //s7-other
                $work->save();
            }
        }
    }
    
    private function getItem ($request)
    {
        $id = $request->getParameter ('id');
        
        $item = Doctrine::getTable('LeaveRequest')->getWithIdAndStatus ($id, "Pending");
        
        $this->forward404Unless ($item);
        
        return $item;
    }
    
    
    /* * * End of Private Functions * * */
    
    
    public function executeApprove (sfWebRequest $request)
    {
        $item = $this->getItem ($request);
        
            $this->updateStatus ($item, "Accepted");
        
        $this->getUser()->setFlash ('notice', 'Day approved successfuly.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeDeny (sfWebRequest $request)
    {
        $item = $this->getItem ($request);
        
            $this->updateStatus ($item, "Denied");
        
        $this->getUser()->setFlash ('notice', 'Day denied successfuly.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeDetails (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('LeaveRequest')->findOneById ($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
    }
    
    
    public function executeList (sfWebRequest $request)
    {
        $this->resultLimit = 100;
        
        // Edit these variables
    
        $_q = Doctrine_Query::create()
            ->from ('LeaveRequest l')
            ->leftJoin ('l.Employee e')
            ->leftJoin ('l.LeaveType t')
            ->innerJoin ('l.WorkingHourDay d')
            ->addWhere ('l.status = ?', "Pending")
            ->limit ($this->resultLimit);
        
        $filterClass = new FmcFilter ('whFilter_leaveRequest');
    
        $this->items = $filterClass->initFilterForm($request, $_q)->execute()->toArray();
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
}
