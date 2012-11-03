<?php

abstract class BaseemployeeManagementActions extends sfActions {
    
    
    public function executeList (sfWebRequest $request) {
        
        $query = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->innerJoin('u.Department d')
            ->orderBy('username ASC');
        
        $filterClass = new FmcFilter('filterform_plugin_sfguarduser');
        
        $this->items = $filterClass
            ->initFilterForm($request, $query)
            ->fetchArray();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
    }
    
    
    public function executeNew (sfWebRequest $request) {
        
        $this->form = new form_plugin_sfguarduser_new();
        
        $url = $this->getController()->genUrl('@employeeManagement');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
        $this->setTemplate('record');
    }
    
    
    public function executeEdit (sfWebRequest $request) {
        
        $this->item = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter("id"));
        $this->forward404Unless ($this->item);
        
        $this->form = new form_plugin_sfguarduser ($this->item);
        
        $url = $this->getController()->genUrl('@employeeManagement');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
        $this->setTemplate('record');
    }
    
    
}
