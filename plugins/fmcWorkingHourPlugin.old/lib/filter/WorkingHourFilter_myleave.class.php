<?php

class WorkingHourFilter_myleave extends PluginWorkingHourLeaveFormFilter {
    
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
        
        $this->setWidget('description', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('description', new sfValidatorPass(array('required' => false)));
        
        $this->useFields(array(
            'type', 
            'description', 
            'status', 
        ));
        
    }
}
