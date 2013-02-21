<?php

class whFilter_manageday extends WorkingHourDayFormFilter
{    
    public function configure()
    {    
    	parent::configure();
    	
        unset(
            $this["multiplier"], 
            $this["daily_Breaks"], 
            $this["leave_id"]
        );
        
    }
}
