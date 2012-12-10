<?php

class whForm_newLeaveWoReport extends whForm_newLeaveWReport
{
    
    public function configure()
    {
        parent::configure();

        unset(
            $this['report_Number'],
            $this['report_Date'],
            $this['report_Received']
        );
    }
    
}
