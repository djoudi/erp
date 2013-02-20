<?php

class whFilter_addhours extends CustomWorkingHourFormFilter
{    
    public function configure()
    {    
    	parent::configure();
    	
        unset(
            $this['minutes']
        );
    }
}
