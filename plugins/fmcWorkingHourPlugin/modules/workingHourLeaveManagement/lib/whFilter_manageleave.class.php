<?php

class whFilter_manageleave extends LeaveRequestFormFilter
{    
    public function configure()
    {    
    	parent::configure();
    	
        unset(
            $this["comment"], 
            $this["report_Date"],
            $this["start_Date"],
            $this["end_Date"],
            $this["day_Count"],
            $this["report_Received"]
        );        
    }
}
