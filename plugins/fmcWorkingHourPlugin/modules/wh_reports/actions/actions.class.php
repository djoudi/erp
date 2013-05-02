<?php

class wh_reportsActions extends sfActions
{
    
    public function executeMain (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable("sfGuardUser")->getActive();
        
        $class = new whReport();
        
        $results = array();
        
        foreach ($this->employees as $employee)
        {
            $results [$user_id = $employee->getId()] = $class->calculateEmployeeBalanceToDate ($user_id, date("Y-m-d"));
        }
        
        print_r ($results);
        
        
    }
    
}
