<?php

abstract class BaseWHParam_WorkTypeActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourWorkType')->findAll();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new WorkingHourWorkType_CustomForm ();
        
        $returnUrl = $this->getController()->genUrl('@whparam_worktype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('WorkingHourWorkType')
            ->findOneById($request->getParameter('id'));
        $this->forward404Unless ($this->object);
        
        $this->form = new WorkingHourWorkType_CustomForm ($this->object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_worktype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
}
