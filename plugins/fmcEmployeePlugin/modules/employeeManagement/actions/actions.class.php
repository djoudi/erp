<?php

class employeeManagementActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->activeEmployees = Doctrine_Query::create()
            ->from ('sfGuardUser u')
            ->addWhere ('u.is_active = ?', true)
            ->execute();
        
        $this->inactiveEmployees = Doctrine_Query::create()
            ->from ('sfGuardUser u')
            ->addWhere ('u.is_active = ?', false)
            ->execute();
        
        $this->allEmployees = Doctrine_Query::create()
            ->from ('sfGuardUser u')
            ->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new form_plugin_sfguarduser_new();
        
        $returnUrl = $this->getController()->genUrl('@employeeManagement');
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@employeeManagement");
        $this->title = "New Employee";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('sfGuardUser')->findOneById ($request->getParameter("id"));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new form_plugin_sfguarduser ($this->item);
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@employeeManagement");
        $this->title = "Employee: {$this->item->getName()}";
        $this->rightList_title = "Worktypes of this user's department";
        $this->rightList_items = $this->item->getDepartment()->getWorkTypes();
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
