<?php

abstract class BaseworkingHourAdminActions extends sfActions {
    
    public function executeSetleaveforall (sfWebRequest $request) {
        
        $redirectUrl = $request->getReferer();
        
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_LeaveSetAll ($request, $redirectUrl);
        
    }
    
    public function executeSetmonthlyhoursforall (sfWebRequest $request) {
        
        $redirectUrl = $request->getReferer();
        
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_MonthyHourSetAll ($request, $redirectUrl);
    }
    
}
