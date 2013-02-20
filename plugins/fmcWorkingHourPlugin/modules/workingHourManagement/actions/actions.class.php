<?php

class workingHourManagementActions extends sfActions
{
    public function executeAddhours (sfWebRequest $request)
    {
        $this->resultLimit = 50;
        
        // Edit these variables
        
        $q = Doctrine::getTable("CustomWorkingHour")
            ->createQuery('cwh')
            ->leftJoin('cwh.Employee e')
            ->leftJoin('cwh.Adder a')
            ->limit ($this->resultLimit);
        
        #$filterClass = new FmcFilter('filter_costFormItemReport_list');
        $filterClass = new FmcFilter('whFilter_addhours');
    
        $this->items = $filterClass->initFilterForm($request, $q)->execute();
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
    
    public function executeAddhoursNew (sfWebRequest $request)
    {
        $object = new CustomWorkingHour();
        $object->setAdder ($this->getUser()->getGuardUser());
        $object->setDate (date("Y-m-d"));
        
        $this->form = new whForm_addhours_new ($object);
        
        $returnUrl = $this->getController()->genUrl('@workingHoursManagement_addhours');
        
        Fmc_Core_Form::Process ($this->form, $request, $returnUrl);
    }
    
    public function executeAddhoursEdit (sfWebRequest $request)
    {
        $this->item = Doctrine::getTable('CustomWorkingHour')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->item);
        
        $this->form = new whForm_addhours_new ($this->item);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    public function executeAddhoursDelete (sfWebRequest $request)
    {
        $item = Doctrine::getTable('CustomWorkingHour')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($item);
        
        $item->delete();
        
        $this->getUser()->setFlash("success", "Custom working hour is deleted.");
        
        $this->redirect($request->getReferer());
    }
    
}
