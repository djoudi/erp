<?php

class workingHourLeaveLimitActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable ('sfGuardUser')->findAll();
    }
    
    
    
    public function executeDetails (sfWebRequest $request)
    {
        $this->employee = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter('id'));
        
        $this->forward404Unless ($this->employee);
        
        $this->iwrLeave = Doctrine::getTable('WorkingHourParameter')
            ->findOneByParam('IllnessWithoutReportsType');
        
        $this->iwrLeaveCount = Doctrine::getTable('WorkingHourParameter')
            ->findOneByParam('IllnessWithoutReportsYearlyLimit');
        
        $object = new LeaveRequestEmployeeLimit();
        
        $object->setEmployee ($this->employee);
        
        $object->setAdder ($this->getUser()->getGuardUser());
        
        $this->form = new whForm_addleaveemployee ($object);
        
        $this->leaveTypes = Doctrine::getTable ('LeaveType')->findAll();
        
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
