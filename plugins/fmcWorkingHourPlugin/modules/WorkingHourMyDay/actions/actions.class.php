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
    
}
