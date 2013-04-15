<?php

class workingHourApproveLeaveActions extends sfActions
{
    
    public function checkIfDepartmentManager ($request)
    {
        $this->department = $this->getUser()->getGuardUser()->getManagedDepartment();
        
        if ( !$this->department )
        {
            $this->getUser()->setFlash ("error", "You have to be a department manager to approve leave requests!");
            $this->redirect ($this->redirect("@homepage"));
        }
    }
    
    public function checkIfOwnDepartmentsEmployee ($item)
    {
        if ($this->department->getId() != $item->getEmployee()->getDepartment()->getId())
        {
            $this->getUser()->setFlash ("error", "Selected employee is not working for your department!");
            $this->redirect ($this->redirect("@homepage"));
        }
    }
    
    
    public function executeSetstatus (sfWebRequest $request)
    {
        // Checking if logged in user is a department manager
            
            $this->checkIfDepartmentManager ($request);
        
        // Fetching item
        
            $item = Doctrine::getTable('LeaveRequest')->getWithIdAndStatus ($request->getParameter ('id'), "Pending");
            
            $this->forward404Unless ($item);
        
        // Checking if employee of leave request is under logged-in user's department
        
            $this->checkIfOwnDepartmentsEmployee ($item);
        
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
        // Checking if logged in user is a department manager
            
            $this->checkIfDepartmentManager ($request);
        
        // Fetching item
        
            $this->item = Doctrine::getTable('LeaveRequest')->findOneById ($request->getParameter('id'));
            
            $this->forward404Unless ($this->item);
        
        // Checking if employee of leave request is under logged-in user's department
        
            $this->checkIfOwnDepartmentsEmployee ($this->item);
        
        // Preparing form
        
            $this->reportForm = new whForm_leaveRequestReport ($this->item);
            
        // Processing form
            
            Fmc_Core_Form::Process ($this->reportForm, $request);
    }
    
    
    
    public function executeList (sfWebRequest $request)
    {
        // Checking if logged in user is a department manager
            
            $this->checkIfDepartmentManager ($request);
        
        // Preparing Filter
        
            $this->resultLimit = 100;
            
            $q = whQuery::prepareLeaveApproveQuery ($this->resultLimit, $this->department->getId());
            
            $filterClass = new FmcFilter ('whFilter_leaveRequest');
            
            $this->items = $filterClass->initFilterForm($request, $q)->execute()->toArray();
            
        // Do not touch here
      
            if ($request->hasParameter('_reset')) $filterClass->resetForm ();
            
            $this->filter = $filterClass->getFilter();
            
            $this->filtered = $filterClass->getFiltered();
    }
    
}
