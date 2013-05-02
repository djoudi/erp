<?php

class wh_user_reportsActions extends sfActions
{
    public function executeBydate (sfWebRequest $request)
    {
        /*
        //$user_id = $this->getUser()->getGuardUser()->getId();
        $user_id = 39; // For testing
        
        $endDate = date("Y-m-d");
        
        $class = new whReport;
        
        // Week work
        
        $weekWorkStartDate = new DateTime (date("Y-m-d"));
        $weekWorkStartDate->sub (new DateInterval("P".(date("N")-1)."D"));
        $this->weekWorkStartDate = $weekWorkStartDate->format("Y-m-d");
        
        $this->weekWork = $class->BalanceResultsForDateInterval ($user_id, $this->weekWorkStartDate, $endDate);
        $this->weekWorkLastBalance = $class->getUpToDayBalance();
        
        // Month work
        
        $monthWorkStartDate = new DateTime (date("Y-m-d"));
        $monthWorkStartDate->sub (new DateInterval("P".(date("j")-1)."D"));
        $this->monthWorkStartDate = $monthWorkStartDate->format("Y-m-d");
        
        $this->monthWork = $class->BalanceResultsForDateInterval ($user_id, $this->monthWorkStartDate, $endDate);
        $this->monthWorkLastBalance = $class->getUpToDayBalance();
        
        // All work
        
        $this->allWorkStartDate = "2013-01-01";
        
        #$class->BalanceResultsForDateInterval ($user_id, $this->allWorkStartDate, $endDate);
        
        $this->allWork = $class->BalanceResultsForDateInterval ($user_id, $this->allWorkStartDate, $endDate);
        
        $this->allWorkLastBalance = $class->getUpToDayBalance();
        */
        
        whReport::getLatestBalanceForEveryone();
    }
}
