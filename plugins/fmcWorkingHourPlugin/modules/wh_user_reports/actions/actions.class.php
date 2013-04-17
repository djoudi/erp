<?php

class wh_user_reportsActions extends sfActions
{
    public function executeBydate (sfWebRequest $request)
    {
        $user_id = $this->getUser()->getGuardUser()->getId();
        
        $this->startDate = "2013-04-01";
        $this->endDate = date("Y-m-d");
        
        $class = new whReport();
        
        $this->results = $class->BalanceResultsForDateInterval ($user_id, $this->startDate, $this->endDate);
        
        $this->lastBalance = $class->calculateEmployeeBalanceToDate ($user_id, $this->startDate);
    }
}
