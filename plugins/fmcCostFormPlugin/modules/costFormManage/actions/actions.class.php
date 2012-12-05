<?php

class costFormManageActions extends sfActions
{
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->cost = Doctrine::getTable('CostFormItem')->findOneById($request->getParameter('cost_id'));
        
        $this->forward404Unless ($this->cost);
        
        $this->form = new form_costFormUser_newItem($this->cost);
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    public function executeDelete (sfWebRequest $request)
    {
        $this->cost = Doctrine::getTable('CostFormItem')->findOneById($request->getParameter('cost_id'));
        
        $this->forward404Unless ($this->cost);
        
        $this->cost->delete();
        
        $this->getUser()->setFlash("success", "Cost form is deleted.");
        
        $this->redirect($request->getReferer());
    }
    
}
