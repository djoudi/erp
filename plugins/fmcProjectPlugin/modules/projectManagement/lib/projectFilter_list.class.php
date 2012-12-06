<?php

class projectFilter_list extends ProjectFormFilter
{
    
    public function configure()
    {
        parent::configure();
        
        $this->setWidget('title', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('title', new sfValidatorPass(array('required' => false)));
        
        $this->setWidget('description', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('description', new sfValidatorPass(array('required' => false)));
    }
    
}
