<?php

abstract class BaseworkingHourAdminActions extends sfActions {
    
    
    public function executeSetleaveforall (sfWebRequest $request) {
        
        $redirectUrl = $request->getReferer();
        
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_LeaveSetAll ($request, $redirectUrl);
        
    }
    
    
    public function executeSetmonthlyhoursforall (sfWebRequest $request) {
        
        $redirectUrl = $request->getReferer();
        
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_MonthyHourSetAll ($request, $redirectUrl);
    }
    
    
    public function executeWorkTypeList (sfWebRequest $request) {
        
        $query = Doctrine_Query::create()
            ->from('WorkType wt')
            ->orderBy('code ASC');
      
        $filterClass = new FmcFilter('WorkingHourFilter_worktype');
        
        $this->items = $filterClass->initFilterForm($request, $query)->execute()->toArray();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
    }
    
    
    public function executeWorkTypeNew (sfWebRequest $request) {
        $this->form = new WorkingHourForm_worktype();
        
        $processClass = new FmcProcessForm();
        $processClass->ProcessForm($this->form, $request, "@workingHourWorkType_list", true);
        
    }
    
    
    public function executeWorkTypeEdit (sfWebRequest $request) {
        
        $this->item = Doctrine::getTable('WorkType')->findOneById ($request->getParameter("id"));
        $this->forward404Unless ($this->item);
        
        $this->form = new WorkingHourForm_worktype ($this->item);
        
        $processClass = new FmcProcessForm();
        $processClass->ProcessForm($this->form, $request, "@workingHourWorkType_list", false);
        
    }
    
    
}
