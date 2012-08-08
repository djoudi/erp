<?php

abstract class BasedepartmentManagementActions extends sfActions {
    
    
    public function executeList (sfWebRequest $request) {
        
        $query = Doctrine_Query::create()
            ->from('sfGuardGroup g')
            ->leftJoin ('g.Manager m')
            ->orderBy('name ASC');
        
        $filterClass = new FmcFilter('filterform_department');
        
        $this->items = $filterClass
            ->initFilterForm($request, $query)
            ->fetchArray();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
    }
    
    
    public function executeNew (sfWebRequest $request) {
        
        $this->form = new sfGuardDepartmentForm();
        
        $url = $this->getController()->genUrl('@departmentManagement_list');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
    }
    
    
    public function executeEdit (sfWebRequest $request) {
        
        $this->item = Doctrine::getTable('sfGuardGroup')->findOneById ($request->getParameter("id"));
        $this->forward404Unless ($this->item);
    
        $this->form = new sfGuardDepartmentForm ($this->item);
        
        $url = $this->getController()->genUrl('@departmentManagement_list');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
    }
    
    
}
