<?php

class workingHourParameterActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourParameter')->findAll();
    }
    
    
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('WorkingHourParameter')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->object);
        
        $formType = ($this->object->getParam()=="IllnessWithoutReportsType") ? "Form_Parameter_Leave" : "Form_Parameter";
        
        $this->form = new $formType ($this->object);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }

}
