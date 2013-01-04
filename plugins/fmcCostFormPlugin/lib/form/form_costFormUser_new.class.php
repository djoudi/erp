<?php

class form_costFormUser_new extends PluginCostFormForm
{
    
    public function configure()
    {
    	parent::configure();
    	
        unset(
            $this['isSent']
        );
        
        $uid = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        $this->setWidget('employee_id', new sfWidgetFormInputHidden(array(),array('value'=>$uid)));
        
        $this->setWidget('project_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Projects'),
            'table_method' => 'getActive',
            'add_empty' => false)
        ));
        
        $this->setWidget('currency_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Currencies'),
            'table_method' => 'getActive',
            'add_empty' => false)
        ));
        
        $curDefault = Doctrine::getTable('Currency')->findOneByisDefault(true)->id;
        
        $this->setDefault('currency_id', $curDefault);
    }
    
}
