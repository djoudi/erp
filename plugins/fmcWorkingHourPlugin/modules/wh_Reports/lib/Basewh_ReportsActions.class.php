<?php

abstract class Basewh_ReportsActions extends sfActions {
    
    public function executeOfficeentrance (sfWebRequest $request) {
        
        // Checking date selected
        
            $this->date = $request->getParameter('date');
        
        // If a date is selected
        
            if ($this->date) { //
                
                $this->users = Doctrine::getTable('sfGuardUser')
                    ->createQuery('u')
                    ->leftJoin ('u.Department d')
                    ->addWhere ('u.is_active = ?', true)
                    ->addWhere ('u.username <> ?', 'yasin')
                    ->orderBy('first_name ASC')
                    ->execute();
                
            }
        
    }
    
}
