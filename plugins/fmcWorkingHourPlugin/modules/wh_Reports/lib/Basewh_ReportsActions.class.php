<?php

abstract class Basewh_ReportsActions extends sfActions {
    
    public function executeOfficeentrance (sfWebRequest $request) {
        
        // Checking date selected
        
            $this->date = $request->getParameter('date');
        
        // If a date is selected
        
            if ($this->date) { //
                
                $this->users = Doctrine::getTable('sfGuardUser')
                    ->findByIsActive(true);
                    #->orderBy('first_name ASC')
                    #->execute();
                
            }
        
        #echo $this->date;
        
    }
    
}
