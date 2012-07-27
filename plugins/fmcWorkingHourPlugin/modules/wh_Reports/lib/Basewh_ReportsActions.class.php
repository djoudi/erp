<?php

abstract class Basewh_ReportsActions extends sfActions {
    
    public function executeOfficeentrance (sfWebRequest $request) {
        
        $this->date = $request->getParameter('date');
        #echo $this->date;
        
    }
    
}
