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
        $this->date = $request->getParameter ('date');
        
        whDayInfo::routeDay ($this->date, "New");
        
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
    }
    
    
    public function executeWork (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        
        whDayInfo::routeDay ($this->date, "Work");
        
        $this->day = Doctrine::getTable('WorkingHourDay')->getActiveDate($this->date);
        
        $this->prepareWorkForms ($this->day);
        
        // Processing Forms
        
        $form_id = $request->getParameter('form_id');
        
        $url = $this->getController()->genUrl('@workingHourDay_work?date='.$this->date);
        
        if ($form_id == 1) whDayForm::processNewWork ($this->workForm, $request, $url);
        
        elseif ($form_id == 2) whDayForm::processNewWork ($this->exitForm, $request, $url);
        
        elseif ($form_id == 3) whDayForm::processNewWork ($this->entranceForm, $request, $url);
    }
    
    
    public function executeDeleteItem (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        
        $id = $request->getParameter ('id');
        
        Doctrine::getTable ('WorkingHourRecord')->deleteDraftItem ($date, $id);
        
        $this->redirect ($this->getController()->genUrl('@workingHourDay_check?date='.$date));

    }
    
    
    public function executeDeleteDay (sfWebRequest $request)
    {
        $day = Doctrine::getTable ('WorkingHourDay')->getDraftDate($request->getParameter ('date'));
        
        $this->forward404Unless ($day);
        
        $day->getWorkingHourRecords()->delete();
        
        $day->delete();
        
        $this->getUser()->setFlash('notice','Day deleted.');
        
        $this->redirect ($request->getReferer());
    }
    
    
    public function executeApproveDay (sfWebRequest $request)
    {
        $day = Doctrine::getTable ('WorkingHourDay')->getDraftDate($request->getParameter ('date'));
        
        $this->forward404Unless ($day);
        
        if ($error = $day->verifyRecords())
        {
            $this->getUser()->setFlash('error', $error);
        }
        else
        {
            $day->setStatus ("Pending");
            
            $day->setMultiplier ($day->calculateMultiplier());
            
            $day->save();
            
            $this->getUser()->setFlash('warning', "Your day is sent for approval.");
        }
                
        $this->redirect ($request->getReferer());
    }
    
}
