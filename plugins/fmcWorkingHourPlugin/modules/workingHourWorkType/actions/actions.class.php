<?php

class workingHourWorkTypeActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourWorkType')->findAll();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new Form_WorkType ();
        
        $returnUrl = $this->getController()->genUrl('@workingHourWorkType_list');
        
        $this->activeClass = "#topmenu_workinghours";
        $this->back_url = $this->getController()->genUrl("@workingHourWorkType_list");
        $this->title = "New Work Type";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('WorkingHourWorkType')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new Form_WorkType ($this->item);
        
        $this->activeClass = "#topmenu_workinghours";
        $this->back_url = $this->getController()->genUrl("@workingHourWorkType_list");
        $this->title = "Worktype: {$this->item}";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
