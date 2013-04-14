<?php

class customerManagementActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        // Filter: Edit these variables
        
        $_q = Doctrine_Query::create()->from('Customer u');
        
        $filterClass = new FmcFilter('CustomerFormFilter');
        
        $this->customers = $filterClass->initFilterForm($request, $_q)->execute();
    
        // Filter: Do not touch here
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
    
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('Customer')->findOneById ($request->getParameter("id"));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new customerForm ($this->item);
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@customerManagement");
        $this->title = "Customer {$this->item['name']}";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new customerForm();
        
        $url = $this->getController()->genUrl('@customerManagement');
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@customerManagement");
        $this->title = "New Customer";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request, $url);
    }
    
}
