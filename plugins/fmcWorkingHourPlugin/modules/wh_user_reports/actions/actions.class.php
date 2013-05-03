<?php

class wh_user_reportsActions extends sfActions
{
    public function executeBydate (sfWebRequest $request)
    {
        $this->employee = $this->getUser()->getGuardUser();
        
        $today = new DateTime (date("Y-m-d"));
        $thisMonth = $today->format("Y-m");
        
        if (!$yearMonth = $request->getParameter("month"))
        {
            $this->redirect($this->getController()->genUrl("@wh_user_reports-bydate")."?month={$thisMonth}");
        }
        else
        {
            $startDate = new DateTime ($yearMonth."-01");
            $this->startDate = $startDate->format("Y-m-d");
            
            $endDate = new DateTime ($this->startDate);
            $endDate->add (new DateInterval("P1M"));
            $endDate->sub (new DateInterval("P1D"));
            $this->endDate = $endDate->format("Y-m-d");
            
            if ($today<$endDate) $this->endDate = date("Y-m-d");
            
            if ( ($startDate > $today) || ($this->startDate < "2013-01-01") )
            {
                $this->redirect($this->getController()->genUrl("@wh_user_reports-bydate"));#."?month={$thisMonth}");
            }
            
            $prevMonth = new DateTime ($this->startDate);
            $prevMonth->sub (new DateInterval("P1M"));
            $this->prevMonth = ($this->startDate>="2013-02-01") ? $prevMonth->format("Y-m") : NULL;
            
            $nextMonth = new DateTime ($this->startDate);
            $nextMonth->add (new DateInterval("P1M"));
            $this->nextMonth = ($today<$endDate) ? NULL : $nextMonth->format("Y-m");
        }
        
        $class = new whReport;
        
        $this->results = $class->BalanceResultsForDateInterval ($this->employee->getId(), $this->startDate, $this->endDate);
        
        $this->lastBalance = $class->getUpToDayBalance();
    }
}
