<?php

abstract class BaseprojectManagementActions extends sfActions {
    
    
    public function executeIndex (sfWebRequest $request) {
        
        $query = Doctrine_Query::create()
            ->from ('Project p')
            ->innerJoin ('p.Customers c')
            ->orderBy('code ASC');
            
        $filterClass = new FmcFilter('ProjectFormFilter');
      
        $this->items = $filterClass
            ->initFilterForm($request, $query)
            ->execute();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
    }
  
    
    public function executeNew (sfWebRequest $request) {
        
        $this->form = new projectForm();
        
        $url = $this->getController()->genUrl('@projectManagement');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
    }
    
    
    public function executeEdit (sfWebRequest $request) {
        
        $this->item = Doctrine::getTable('Project')->findOneById ($request->getParameter("id"));
        $this->forward404Unless ($this->item);
        
        $this->form = new projectForm ($this->item);
        
        $url = $this->getController()->genUrl('@projectManagement');
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
        
    }
    
    
}
