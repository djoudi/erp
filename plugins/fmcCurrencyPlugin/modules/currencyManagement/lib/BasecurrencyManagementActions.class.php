<?php

abstract class BasecurrencyManagementActions extends sfActions {
    
    
    
    public function executeIndex (sfWebRequest $request) {
        
        $this->list = Doctrine::getTable('Currency')
            ->createQuery()
            ->orderBy('code ASC')
            ->execute();
        
        $this->form = new form_plugin_currency_add();
        
        $url = $request->getReferer();
        
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $url);
    }
    
    
    
    public function executeDisable (sfWebRequest $request) {
      
        $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($object);
    
        if ($object->getIsDefault()) {
            
            $this->getUser()->setFlash("error", 'You cannot disable default currency!');
            
        } else {
            
            $object->setIsActive(false);
            $object->save();
            $this->getUser()->setFlash("notice", sprintf('Currency %s is disabled!', $object['code']));
        }
        
        $this->redirect($request->getReferer());
    }
    
    
    
    public function executeEnable (sfWebRequest $request) {
      
        $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($object);
        
        $object->setIsActive(true);
        $object->save();
        
        $this->getUser()->setFlash("notice", sprintf('Currency %s is enabled!', $object['code']));
        $this->redirect($request->getReferer());
    }
    
    
    
    public function executeMakeDefault (sfWebRequest $request) {
        
        $object = Doctrine::getTable('Currency')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($object);
        
        if (!$object->getIsActive()) {
            
            $this->getUser()->setFlash("error", "You cannot make a disabled currency default!");
            
        } else {
      
            if ( $oldDefault = Doctrine::getTable('Currency')->findOneByisDefault(true) ) {
        
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
