<?php

class workingHourManagementActions extends sfActions
{
    public function executeDayList (sfWebRequest $request)
    {
        $this->resultLimit = 50;
        
        $q = Doctrine::getTable("WorkingHourDay")
            ->createQuery ('whd')
            ->leftJoin ('whd.Employee e')
            ->leftJoin ('whd.LeaveRequest lr')
            ->addWhere ('whd.leave_id IS NULL')
            ->limit ($this->resultLimit);
        
        $filterClass = new FmcFilter('whFilter_manageday');
    
        $this->items = $filterClass->initFilterForm($request, $q)->execute();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
    }
    
    public function executeDayMakeDraft (sfWebRequest $request)
    {
        $item = Doctrine::getTable("WorkingHourDay")->findOneById($request->getParameter("id"));
        
        $this->forward404Unless ($item);
        
        if ($item["status"] != "Accepted")
        {
            $this->getUser()->setFlash("error", "Only accepted days can be changed to draft!");
        }
        else
        {
            $item->setStatus ("Draft");
            $item->save();
            $this->getUser()->setFlash("success", "Day <strong>{$item["date"]}</strong> of employee <strong>{$item->getEmployee()}</strong> changed to draft!");
        }
        
        $this->redirect ($request->getReferer());
    }
    
    public function prepareWorkForms ($day)
    {
        $workObject = new WorkingHourRecord ();
        $workObject->setDay ($day);
        $workObject->setRecordType ("Work");
        $this->workForm = new whForm_workRecord ($workObject);
        
        $entranceObject = new WorkingHourRecord ();
        $entranceObject->setDay ($day);
        $entranceObject->setRecordType ("Entrance");
        $this->entranceForm = new whForm_entranceRecord ($entranceObject);
        
        $exitObject = new WorkingHourRecord ();
        $exitObject->setDay ($day);
        $exitObject->setRecordType ("Exit");
        $this->exitForm = new whForm_exitRecord ($exitObject);
        
        $this->dailyBreaksForm = new whForm_dailyBreaks ();
        $this->dailyBreaksForm->setDefaults(array(
            'total_Daily_Breaks' => $day['daily_Breaks']
        ));
    }
    
    public function executeDayEdit (sfWebRequest $request)
    {
        $this->admin = 1;
        
        // Same as workingHourDay-Work
        
        $this->day = Doctrine::getTable("WorkingHourDay")->findOneById($request->getParameter("id"));
        
        $this->forward404Unless ($this->day);
        
        $this->date = $this->day->getDate();
        
        if ($this->day->getStatus() != "Draft")
        {
            $this->getUser()->setFlash("error", "Only draft days can be edited!");
            $this->redirect ($this->getController()->genUrl("@workingHoursManagement_day_list"));
        }
        else
        {
            $this->dayRecords = $this->day->getRecords()->toArray();
        
            $this->prepareWorkForms ($this->day);
            
            // Processing Forms
            
            $form_id = $request->getParameter('form_id');
            
            if ($form_id == 1) whDayForm::processNewWork ($this->workForm, $request, NULL);
            
            elseif ($form_id == 2) whDayForm::processNewWork ($this->exitForm, $request, NULL);
            
            elseif ($form_id == 3) whDayForm::processNewWork ($this->entranceForm, $request, NULL);
            
            elseif ($form_id == 4) whDayForm::processDailyBreaks ($this->dailyBreaksForm, $request, NULL);
        }
        
        $this->setTemplate('work','workingHourDay','fmcWorkingHourPlugin');
    }
    
    public function executeAddhours (sfWebRequest $request)
    {
        $this->resultLimit = 50;
        
        $q = Doctrine::getTable("CustomWorkingHour")
            ->createQuery('cwh')
            ->leftJoin('cwh.Employee e')
            ->leftJoin('cwh.Adder a')
            ->limit ($this->resultLimit);
        
        $filterClass = new FmcFilter('whFilter_addhours');
    
        $this->items = $filterClass->initFilterForm($request, $q)->execute();
        
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
