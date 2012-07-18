<?php

abstract class BaseworkingHourLeaveActions extends sfActions {
    
    public function executeSetall (sfWebRequest $request) {
        
        $redirectUrl = $request->getReferer();
        
        $processClass = new FmcWhUser_Process();
        $processClass->workingHour_LeaveSetAll ($request, $redirectUrl);
        
    }
    
}

