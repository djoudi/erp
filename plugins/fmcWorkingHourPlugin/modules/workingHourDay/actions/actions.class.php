<?php

class workingHourDayActions extends sfActions
{
    
    public function executeCheck (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        
        if (!$date) $date = date ('Y-m-d');
        
        whDayInfo::routeDay ($date);
    }
    
    
    public function executeNew (sfWebRequest $request)
    {
        whDayInfo::routeDay ($this->date = $request->getParameter ('date'), "New");
        
        $this->form = new whForm_newDay ();
        
        whDayForm::processNewday ($this->form, $request, $this->date);
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
    
    
    public function executeWork (sfWebRequest $request)
    {
        whDayInfo::routeDay ($this->date = $request->getParameter ('date'), "Work");
        
        $this->admin = 0;
        
        $this->day = Doctrine::getTable ('WorkingHourDay')->getActiveDate($this->date);
        
        $this->forward404Unless ($this->day);
        
        $this->dayRecords = $this->day->getRecords()->toArray();
        
        $this->prepareWorkForms ($this->day);
        
        // Processing Forms
        
        $form_id = $request->getParameter('form_id');
        
        if ($form_id == 1) whDayForm::processNewWork ($this->workForm, $request, NULL);
        
        elseif ($form_id == 2) whDayForm::processNewWork ($this->exitForm, $request, NULL);
        
        elseif ($form_id == 3) whDayForm::processNewWork ($this->entranceForm, $request, NULL);
        
        elseif ($form_id == 4) whDayForm::processDailyBreaks ($this->dailyBreaksForm, $request, NULL);
    }
    
    
    public function executeDeleteItem (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        $id = $request->getParameter ('id');
        $admin = $request->getParameter ('admin');
        $isAdmin = $admin && $this->getUser()->hasCredential("Working Hours Management") ? 1 : 0;
        
        Doctrine::getTable ('WorkingHourRecord')->deleteDraftItem ($date, $id, NULL, $isAdmin);
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeDeleteDay (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        $id = $request->getParameter ('id');
        $admin = $request->getParameter ('admin');
        $isAdmin = $admin && $this->getUser()->hasCredential("Working Hours Management") ? 1 : 0;
        
        $day = Doctrine::getTable ('WorkingHourDay')->getDraftDate($date, NULL, $isAdmin);
        
        $this->forward404Unless ($day);
        
        if (!$isAdmin)
        {
            whDayInfo::routeDay ($date, "Work");
        }
        
        $day->getWorkingHourRecords()->delete();
        $day->delete();
        $this->getUser()->setFlash('error','Day deleted!');
        
        if ($isAdmin) $this->redirect ($this->getController()->genUrl("@workingHoursManagement_day_list"));
        else $this->redirect ($request->getReferer());
    }
    
    
    public function executeApproveDay (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        $id = $request->getParameter ('id');
        $admin = $request->getParameter ('admin');
        $isAdmin = $admin && $this->getUser()->hasCredential("Working Hours Management") ? 1 : 0;
        
        $day = Doctrine::getTable ('WorkingHourDay')->getDraftDate($date, NULL, $isAdmin);
        
        $this->forward404Unless ($day);
        
        if (!$isAdmin)
        {
            whDayInfo::routeDay ($date, "Work");
        }
                
        if ($error = $day->verifyRecords())
        {
            $this->getUser()->setFlash('error', $error);
            $this->redirect ($request->getReferer());
        }
        else
        {
            $day->setStatus ("Accepted");
            $day->setMultiplier ($day->calculateMultiplier());
            $day->save();
            
            $this->getUser()->setFlash('success', "Day is sent for approval.");
            
            if ($isAdmin) $this->redirect ($this->getController()->genUrl("@workingHoursManagement_day_list"));
            else $this->redirect ($request->getReferer());
        }
    }
    
}
