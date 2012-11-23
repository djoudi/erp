<?php

class employeeManagementActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $query = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->innerJoin('u.Department d');
            
        $this->items = $query->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new form_plugin_sfguarduser_new();
        
        $returnUrl = $this->getController()->genUrl('@employeeManagement');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter("id"));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new form_plugin_sfguarduser ($this->item);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
