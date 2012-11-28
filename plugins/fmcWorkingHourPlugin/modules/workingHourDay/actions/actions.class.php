<?php

class workingHourDayActions extends sfActions
{
    
    public function executeCheck (sfWebRequest $request)
    {
        $date = $request->getParameter ('date');
        if (!$date) $date = date ('Y-m-d');
        
        workingHourStatus::routeDay ($date);
    }
    
    public function executeNew (sfWebRequest $request)
    {
        
    }
    
}
