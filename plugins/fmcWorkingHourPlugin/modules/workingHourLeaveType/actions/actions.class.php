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
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('LeaveType')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->object);
        
        $this->form = new LeaveTypeForm ($this->object);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
