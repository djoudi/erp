<?php

abstract class BaseWHParam_WorkTypeActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourWorkType')
            ->createQuery ('q')
            #->leftJoin('q.Employees e')
            ->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new WorkingHourWorkTypeForm ();
        
        $returnUrl = $this->getController()->genUrl('@whparam_worktype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('WorkingHourWorkType')
            ->findOneById($request->getParameter('id'));
        $this->forward404Unless ($this->object);
        
        $this->form = new WorkingHourWorkTypeForm ($this->object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_worktype_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
}
