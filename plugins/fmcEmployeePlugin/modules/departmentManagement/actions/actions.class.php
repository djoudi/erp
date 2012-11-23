<?php

class departmentManagementActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $q = Doctrine::getTable ('sfGuardGroup')
            ->createQuery ('g')
            ->leftJoin ('g.Manager m');
        
        $this->items = $q->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new sfGuardDepartmentForm();
        
        $returnUrl = $this->getController()->genUrl('@departmentManagement_list');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('sfGuardGroup')->findOneById ($request->getParameter("id"));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new sfGuardDepartmentForm ($this->item);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
