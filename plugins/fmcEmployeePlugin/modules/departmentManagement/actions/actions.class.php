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
        $q = Doctrine::getTable('sfGuardGroup')
            ->createQuery ('g')
            ->leftJoin ('g.Manager m')
            ->leftJoin ('g.Default_Work_Type dwt')
            ->addWhere ('g.id = ?', $request->getParameter("id"));
        
        $this->item = $q->fetchOne();
        
        $this->forward404Unless ($this->item);
        
        $this->form = new sfGuardDepartmentForm ($this->item);
        
        $returnUrl = $this->getController()->genUrl('@departmentManagement_list');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
}
