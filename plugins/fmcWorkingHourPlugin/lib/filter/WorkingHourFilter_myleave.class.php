<?php

class WorkingHourFilter_myleave extends PluginWorkingHourLeaveFormFilter {
    
    public function configure() {
        
        unset ($this['user_id']);
        unset ($this['status_user']);
        unset ($this['date']);
        
        /*
         * @TODO: TODO: These values should be fetched from app.yml automatically
         */
        $this->setWidget('type', new sfWidgetFormChoice(
            array(
                'choices' => array(
                    '' => '', 
                    'IllnessWReport' => 'Illness (with Report)', 
                    'IllnessWoReport' => 'Illness (without Report)', 
                    'PaidVacation' => 'Paid Vacation', 
                    'UnpaidVacation' => 'Unpaid Vacation'
                )
            )
        ));
        
  }
}
