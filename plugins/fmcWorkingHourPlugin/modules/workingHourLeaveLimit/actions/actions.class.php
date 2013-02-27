<?php

class workingHourLeaveLimitActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable ('sfGuardUser')->findAll();
    }
    
    
    
    public function executeDetails (sfWebRequest $request)
    {
        // Fetching employee
        
        $this->employee = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter('id'));
        
        // 404 if employee not found
        
        $this->forward404Unless ($this->employee);
        
        // Fetching previous records
        
        $this->previous = Doctrine::getTable("LeaveRequestEmployeeLimit")->findByEmployeeId ($this->employee->getId());
        
        // Fetching leave types
        
        $this->leaveTypes = Doctrine::getTable ('LeaveType')->findAll();
        
        // Creating form
        
        $this->form = new whForm_addleaveemployee (array(), array('employee_id' => $this->employee->getId()));
        
        // Processing form
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    
    
    public function executeDelete (sfWebRequest $request)
    {
        $item = Doctrine::getTable("LeaveRequestEmployeeLimit")->findOneById($request->getParameter("id"));
        
        $this->forward404Unless ($item);
        
        $item->delete();
        
        $this->getUser()->setFlash("notice", "Leave limit deleted.");
        
        $this->redirect ($request->getReferer());
    }
    
    
}
