<?php

class workingHourParameterActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourParameter')->findAll();
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('WorkingHourParameter')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new Form_Parameter ($this->item);
        
        $this->activeClass = "#topmenu_workinghours";
        $this->back_url = $this->getController()->genUrl("@workingHourParameter_list");
        $this->title = "Edit Parameter: {$this->item->getParam()}";
        
        $this->setTemplate('record','fmcCore','fmcCorePlugin');
        
        Fmc_Core_Form::Process ($this->form, $request);
    }

}
