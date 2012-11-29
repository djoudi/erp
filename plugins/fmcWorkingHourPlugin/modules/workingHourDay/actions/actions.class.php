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
        // Work Form
        $workObject = new WorkingHourRecord ();
        $workObject->setDay ($day);
        $workObject->setRecordType ("Work");
        $this->workForm = new whForm_workRecord ($workObject);
    }
    
    
    public function executeWork (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        
        whDayInfo::routeDay ($this->date, "Work");
        
        $this->day = Doctrine::getTable('WorkingHourDay')->getActiveDate($this->date);
        
        $this->prepareWorkForms ($this->day);
        
        
        // Processing Forms
        
        $form_id = $request->getParameter('form_id');
        
        $url = $this->getController()->genUrl('@workingHourDay_check?date='.$this->date);
        
        if ($form_id == 1) WHUser_MyPage_Lib_Form::MyDay_AddWork ($this->workForm, $request, $url);
        elseif ($form_id == 2) WHUser_MyPage_Lib_Form::MyDay_AddIo ($this->entranceForm, $request, "Entrance", $url);
        elseif ($form_id == 3) WHUser_MyPage_Lib_Form::MyDay_AddIo ($this->exitForm, $request, "Exit", $url);
                
    }
    
}
