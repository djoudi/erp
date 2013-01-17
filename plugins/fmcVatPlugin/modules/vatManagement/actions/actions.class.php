<?php

class vatManagementActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $this->list = Doctrine::getTable('Vat')->findAll();
        
        $this->form = new form_plugin_vat_add();
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    
    public function executeDisable (sfWebRequest $request)
    {
        $object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($object);
        
        if ($object->getIsDefault())
        {
            $this->getUser()->setFlash("error", 'You cannot disable default VAT!');
        }
        else
        {
            $object->setIsActive(false);
            $object->save();
            
            $this->getUser()->setFlash("notice", sprintf("Vat rate %s is disabled!", $object['rate']));
        }
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeEnable (sfWebRequest $request)
    {
        $object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($object);
        
        $object->setIsActive(true);
        
        $object->save();
        
        $this->getUser()->setFlash("notice", sprintf("Vat %s is enabled!", $object->getRate()));
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeMakeDefault (sfWebRequest $request)
    {
        $this->forward404Unless ($object = Doctrine::getTable('Vat')->findOneById($request->getParameter('id')));
        
        if (!$object->getIsActive())
        {
            $this->getUser()->setFlash("error", 'You cannot make a disabled VAT default!');
            
        }
        else
        {
            if ( $oldDefault = Doctrine::getTable('Vat')->findOneByisDefault(true) )
            {
                $oldDefault->setIsDefault(false);
                $oldDefault->save();
            }
            
            $object->setIsDefault(true);
            $object->save();
            
            $this->getUser()->setFlash("notice", sprintf('VAT ratio %d is now default!', $object['rate']));
        }
        
        $this->redirect($request->getReferer());
    }
    
}
