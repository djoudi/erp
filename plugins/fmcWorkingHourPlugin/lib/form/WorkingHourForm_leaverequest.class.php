<?php

class WorkingHourForm_leaverequest extends WorkingHourLeaveForm {
    
    public function configure() {
    
        unset($this['user_id']);
        unset($this['type']);
        unset($this['date']);
        unset($this['status']);
        unset($this['status_user']);

        $this->widgetSchema->setLabel('description', "Comment (optional)");
        
    }

}
