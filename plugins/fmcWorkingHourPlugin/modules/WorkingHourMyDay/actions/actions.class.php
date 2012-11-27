<?php

class WorkingHourMyDayActions extends sfActions
{
    
    public function executeCheckday (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        if (!$date) $date = date ('Y-m-d');
        
        Fmc_Wh_Routing::CheckDay ($date);
    }
    
    public function executeNewday (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        Fmc_Wh_Routing::CheckDay ($this->date, "New");
                
        $object = new WorkingHourDay();
        $object->setEmployee ($this->getUser()->getGuardUser());
        $object->setDate ($this->date);
        $this->form = new WHForm_DayIO ($object);
        
        Fmc_Wh_Forms::processNewDayForm ($this->form, $request, $this->date);
    }
    
    public function executeWorkday (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        Fmc_Wh_Routing::CheckDay ($this->date, "Work");
        
        $user_id = $this->getUser()->getGuardUser()->getId();
        
        // Fetching day
        
            $this->day = Doctrine::getTable('WorkingHourDay')->getActiveForUserDate($user_id, $this->date);
            
        // Work form
            
            $workObject = new WorkingHourWork();
            $workObject->setDay ($this->day);
            $this->workForm = new Form_WHUser_newdaywork($workObject);
            
        // Entrance form
            
            $entranceObject = new WorkingHourEntranceExit();
            $entranceObject->setDay ($this->day);
            $entranceObject->setType ('Entrance');
            $this->entranceForm = new Form_WHUser_newdayio($entranceObject);
            
        // Exit form
            
            $exitObject = new WorkingHourEntranceExit();
            $exitObject->setDay ($this->day);
            $exitObject->setType ('Exit');
            $this->exitForm = new Form_WHUser_newdayio($exitObject);
        
        // Day edit form
        
            $this->dayForm = new Form_WH_NewDay ($this->day);
        
        
    }
}
