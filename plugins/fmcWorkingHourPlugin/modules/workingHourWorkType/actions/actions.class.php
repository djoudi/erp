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
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('WorkingHourWorkType')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->object);
        
        $this->form = new Form_WorkType ($this->object);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
}
