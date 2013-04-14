<?php

class workingHourLeaveTypeActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('LeaveType')->findAll();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new LeaveTypeForm ();
        
        $returnUrl = $this->getController()->genUrl('@workingHourLeaveType_list');
        
        $this->activeClass = "#topmenu_workinghours";
        $this->back_url = $this->getController()->genUrl("@workingHourLeaveType_list");
        $this->title = "New Leave Type";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('LeaveType')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new LeaveTypeForm ($this->item);
        
        $this->activeClass = "#topmenu_workinghours";
        $this->back_url = $this->getController()->genUrl("@workingHourLeaveType_list");
        $this->title = "Editing: {$this->item->getName()}";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
