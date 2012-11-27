<?php

class WHUser_DayActions extends sfActions
{
    
    public function executeNewDay (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        Fmc_Wh_Routing::CheckDay ($date, "New");
        
    }
    
    
    
    
    public function executeDay (sfWebRequest $request)
    {
        $this->date = $request->getParameter('date');
        $this->status = Fmc_Wh_Day::getDateType($this->date);
        
        if ($this->status == "empty")
        {
            $object = new WorkingHourDay();
            $object->setEmployee ($this->getUser()->getGuardUser());
            $object->setDate ($this->date);
            $this->form = new Form_WH_NewDay($object);
            
            Fmc_Wh_Forms::processNewDayForm ($this->form, $request, $this->date);
            
            #Fmc_Core_Form::Process ($this->form, $request);
        }
        else
        if ($this->status == "workday")
        {
            

            // Processing Forms
                
                $form_id = $request->getParameter('form_id');
                $url = $this->getController()->genUrl('@wh_my_day?date='.$this->date);
                
                if ($form_id == 1) WHUser_MyPage_Lib_Form::MyDay_AddWork ($this->workForm, $request, $url);
                elseif ($form_id == 2) WHUser_MyPage_Lib_Form::MyDay_AddIo ($this->entranceForm, $request, "Entrance", $url);
                elseif ($form_id == 3) WHUser_MyPage_Lib_Form::MyDay_AddIo ($this->exitForm, $request, "Exit", $url);
                elseif ($form_id == 4) Fmc_Wh_Forms::processNewDayForm ($this->dayForm, $request, $this->date);
                
        }
    }
    
    
    
    public function executeDeleteday (sfWebRequest $request)
    {
        $date = $request->getParameter('date');
        Fmc_Wh_User::DeleteMyDay ($date);
        
        $this->getUser()->setFlash('notice', "Day records deleted.");
        
        $forwardUrl = $this->getController()->genUrl('@wh_my_day?date='.$date);
        $this->getController()->redirect ($forwardUrl);
    }
    
    
    
    public function executeDeleteio (sfWebRequest $request)
    {
        Fmc_Wh_User::DeleteMyIo ($request->getParameter('date'), $request->getParameter('id'));
        $forwardUrl = $this->getController()->genUrl('@wh_my_day?date='.$request->getParameter('date'));
        $this->getController()->redirect ($forwardUrl);
    }
    
    
    
    public function executeDeletework (sfWebRequest $request)
    {
        Fmc_Wh_User::DeleteMyWork ($request->getParameter('date'), $request->getParameter('id'));
        $forwardUrl = $this->getController()->genUrl('@wh_my_day?date='.$request->getParameter('date'));
        $this->getController()->redirect ($forwardUrl);
    }
    
    
    
    public function executeSendapprove (sfWebRequest $request)
    {
        $date = $request->getParameter('date');
        $day = Doctrine::getTable('WorkingHourDay')->getMyDraftForDate($date);
        $this->forward404Unless ($day);
        
        $result = $day->verifyRecords();
        if ($result['status']!="OK")
        {   
            $this->getUser()->setFlash('error', $result['status']);
            $this->getUser()->setFlash($result['errType'], $result['errId']);
        }
        else
        {
            //$this->getUser()->setFlash('notice', "all ok");
            $day->setMultiplier ($day->calculateMultiplier());
            $day->setStatus ('Pending');
            $day->save();
        }
        
        $this->getController()->redirect($request->getReferer());
    }
    
}