<?php

class wh_user_reportsActions extends sfActions
{
    public function executeBydate (sfWebRequest $request)
    {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $user_id = 39;
        
        $this->startDate = "2013-01-01";
        $this->endDate = date("Y-m-d");
        
        $class = new whReport();
        
        $this->results = $class->BalanceResultsForDateInterval ($user_id, $this->startDate, $this->endDate);
        
        $this->lastBalance = $class->getUpToDayBalance();
        
        #$this->lastBalance = $class->calculateEmployeeBalanceToDate ($user_id, $this->startDate);
    }
}
