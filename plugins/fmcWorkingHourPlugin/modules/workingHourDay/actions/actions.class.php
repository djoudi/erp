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
    
    public function executeWork (sfWebRequest $request)
    {
        $this->date = $request->getParameter ('date');
        
        whDayInfo::routeDay ($this->date, "Work");
        
        $this->day = Doctrine::getTable('WorkingHourDay')->getActiveDate($this->date);
    }
    
}
