<?php

class filter_wh_process_leave extends PluginWorkingHourLeaveFormFilter {
    
    public function configure() {
                
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
        
        $this->useFields(array(
            'user_id', 
            'type', 
            'description', 
            'status', 
        ));
                
    }
}
