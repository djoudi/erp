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
        
        $this->form = new HolidayFormRecord ($object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_holiday_list');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('Holiday')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->object);
        
        $this->form = new HolidayFormRecord ($this->object);
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
}
