<?php

class workingHourApproveLeaveActions extends sfActions
{
    
    
    public function executeSetstatus (sfWebRequest $request)
    {
        // Fetching item
        
            $item = Doctrine::getTable('LeaveRequest')->getWithIdAndStatus ($request->getParameter ('id'), "Pending");
            
            $this->forward404Unless ($item);
        
        // Setting and saving status
        
            $status = $request->getParameter ('status');
    
            $item->setStatus ($status);
            $item->save();
        
            foreach ($item->getWorkingHourDay() as $day)
            {
                $day->setStatus ($status);
                $day->save();
            }
            
        // Providing output
        
            $this->getUser()->setFlash ('notice', 'Day approved successfuly.');
        
            $this->redirect ($request->getReferer());
    }
    
    
    
    public function executeDetails (sfWebRequest $request)
    {
        // Fetching item
        
            $this->item = Doctrine::getTable('LeaveRequest')->findOneById ($request->getParameter('id'));
            
            $this->forward404Unless ($this->item);
        
        // Preparing form
        
            $this->reportForm = new whForm_leaveRequestReport ($this->item);
            
        // Processing form
            
            Fmc_Core_Form::Process ($this->reportForm, $request);
    }
    
    
    
    public function executeList (sfWebRequest $request)
    {
        // Preparing Filter
        
            $this->resultLimit = 100;
            
            $q = whQuery::prepareLeaveApproveQuery ($this->resultLimit);
            
            $filterClass = new FmcFilter ('whFilter_leaveRequest');
            
            $this->items = $filterClass->initFilterForm($request, $q)->execute()->toArray();
            
        // Do not touch here
      
            if ($request->hasParameter('_reset')) $filterClass->resetForm ();
            
            $this->filter = $filterClass->getFilter();
            
            $this->filtered = $filterClass->getFiltered();
    }
    
}
