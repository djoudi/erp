<?php

class workingHourApproveLeaveActions extends sfActions
{
    
    public function executeApprove (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $item = Doctrine::getTable('LeaveRequest')->getWithIdAndStatus ($id, "Pending");
        
        $this->forward404Unless ($item);
        
        $item->setStatus ('Accepted');
        
        #$item->save();
        
        $this->getUser()->setFlash ('notice', 'Day approved successfuly.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeDeny (sfWebRequest $request)
    {
        $id = $request->getParameter ('id');
        
        $item = Doctrine::getTable('LeaveRequest')->getWithIdAndStatus ($id, "Pending");
        
        $this->forward404Unless ($item);
        
        $item->setStatus ('Denied');
        
        #$item->save();
        
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
        
        #$filterClass = new FmcFilter('whFilter_dayRequest');
        $filterClass = new FmcFilter ('LeaveRequestFormFilter');
    
        $this->items = $filterClass->initFilterForm($request, $_q)->execute()->toArray();
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
}
