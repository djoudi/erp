<?php

class currencyManagementActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $this->list = Doctrine::getTable('Currency')->findAll();
        
        $this->form = new form_plugin_currency_add();
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    
    public function executeDisable (sfWebRequest $request)
    {
        $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($object);
    
        if ($object->getIsDefault())
        {
            $this->getUser()->setFlash("error", 'You cannot disable default currency!');
        }
        else
        {
            $object->setIsActive(false);
            $object->save();
            
            $this->getUser()->setFlash("notice", sprintf('Currency %s is disabled!', $object['code']));
        }
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeEnable (sfWebRequest $request)
    {
        $this->forward404Unless ($object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id')));
        
        $object->setIsActive(true);
        $object->save();
        
        $this->getUser()->setFlash("notice", sprintf('Currency %s is enabled!', $object['code']));
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeMakeDefault (sfWebRequest $request)
    {
        $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($object);
        
        if (!$object->getIsActive())
        {
            $this->getUser()->setFlash("error", "You cannot make a disabled currency default!");
        }
        else
        {
            if ( $oldDefault = Doctrine::getTable('Currency')->findOneByisDefault(true) )
            {
                $oldDefault->setIsDefault(false);
                $oldDefault->save();
            }
            
            $object->setIsDefault(true);
            $object->save();
            
            $this->getUser()->setFlash("notice", sprintf('Currency %s is now default!', $object['code']));
        }
        
        $this->redirect($request->getReferer());
    }
    
}
