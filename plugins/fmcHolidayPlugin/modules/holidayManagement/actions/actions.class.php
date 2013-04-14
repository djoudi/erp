<?php

class holidayManagementActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('Holiday')->findAll();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $object = new Holiday();
        
        $object->setDay(date('Y-m-d'));
        
        $this->form = new Form_Holiday ($object);
        
        $returnUrl = $this->getController()->genUrl('@holidayManagement_list');
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@holidayManagement_list");
        $this->title = "New Holiday";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('Holiday')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new Form_Holiday ($this->item);
        
        $this->activeClass = "#topmenu_settings";
        $this->back_url = $this->getController()->genUrl("@holidayManagement_list");
        $this->title = "Holiday: {$this->item->getName()}";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
