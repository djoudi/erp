<?php

class form_wh_report_project extends BaseFormDoctrine
{
    
    public function configure()
    {
        $this->setWidgets(array(
            'project_id'  => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getRelatedModelName('Project'), 
                'add_empty' => false
            )),
            'date'         => new sfWidgetFormFilterDate(array(
                'from_date' => new sfWidgetFormJQueryDate(array(
                    'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
                    'image' => '/img/calendar.png',
                    'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
                )),
                'to_date' => new sfWidgetFormJQueryDate(array(
                    'date_widget' => new sfWidgetFormDate(array('format'=>'%day%%month%%year%')),
                    'image' => '/img/calendar.png',
                    'config' => '{ changeMonth: true, changeYear: true, yearRange: "c-100:c" }'
                )),
                'with_empty' => false
            )),
        ));
        
        $this->setValidators(array(
            'project_id'  => new sfValidatorDoctrineChoice(array(
                'required' => true, 
                'model' => $this->getRelatedModelName('Project'), 
                'column' => 'id'
            )),
            'date'         => new sfValidatorDateRange(array(
                'required' => false, 
                'from_date' => new sfValidatorDate(array('required' => true)), 
                'to_date' => new sfValidatorDate(array('required' => true))
            )),
        ));
        
        
        $this->widgetSchema->setNameFormat('filter_wh_report_project_[%s]');
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        
        $this->setupInheritance();
        
        parent::setup();
    }
    
    public function getModelName()
    {
        return 'WorkingHourRecord';
    }
    
    public function getFields()
    {
        return array(
            'project_id'  => 'ForeignKey',
            'date'         => 'Date'
        );
    }
    
}
