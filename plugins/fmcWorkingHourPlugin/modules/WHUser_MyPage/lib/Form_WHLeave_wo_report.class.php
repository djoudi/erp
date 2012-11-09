<?php

class Form_WHLeave_wo_report extends Form_WHLeave_w_report
{
    public function configure()
    {
        parent::configure();

        unset($this['report_Comment']);
        unset($this['report_Date']);
        unset($this['report_Received']);
    }  	
}
