<?php

abstract class BasedepartmentManagementActions extends sfActions {
    
    public function executeList (sfWebRequest $request) {
        
        $query = Doctrine_Query::create()
            ->from('sfGuardGroup g')
            ->orderBy('name ASC');
        
        $filterClass = new FmcFilter('filterform_department');
        
        $this->items = $filterClass->initFilterForm($request, $query)->execute();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
    }
  
    public function executeNew (sfWebRequest $request) {
        
        $this->form = new sfGuardDepartmentForm();
        
        $processClass = new FmcProcessForm();
        $processClass->ProcessForm($this->form, $request, "@departmentManagement_list", true);
        
    }
  
    public function executeEdit (sfWebRequest $request) {
        
        $this->item = Doctrine::getTable('sfGuardGroup')->findOneById ($request->getParameter("id"));
        $this->forward404Unless ($this->item);
    
        $this->form = new sfGuardDepartmentForm ($this->item);
        
        $processClass = new FmcProcessForm();
        $processClass->ProcessForm($this->form, $request, "@departmentManagement_list", false);
        
    }
  
}
