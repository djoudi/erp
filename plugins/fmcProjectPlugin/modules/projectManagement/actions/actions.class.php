<?php

class projectManagementActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $query = Doctrine_Query::create()
            ->from ('Project p')
            ->innerJoin ('p.Customers c');
            
        $filterClass = new FmcFilter('projectFilter_list');
      
        $this->items = $filterClass
            ->initFilterForm($request, $query)
            ->execute();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
    }
  
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new projectForm();
        
        $url = $this->getController()->genUrl('@projectManagement');
        
        Fmc_Core_Form::Process ($this->form, $request, $url);
    }
    
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->forward404Unless($this->item = Doctrine::getTable('Project')->findOneById ($request->getParameter("id")));
        
        $this->form = new projectForm ($this->item);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
