<?php

abstract class BaseWHParam_LeaveTypeActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('LeaveType')
            ->createQuery ('q')
            ->orderBy('name asc')
            ->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new LeaveTypeForm ();
        
        $returnUrl = $this->getController()->genUrl('@whparam_leavetype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('LeaveType')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($this->object);
        
        $this->form = new LeaveTypeForm ($this->object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_leavetype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
}
