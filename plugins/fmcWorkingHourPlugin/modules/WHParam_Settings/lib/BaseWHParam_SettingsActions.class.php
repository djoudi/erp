<?php

abstract class BaseWHParam_SettingsActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->items = Doctrine::getTable ('WorkingHourParameter')
            ->createQuery ('q')
            ->execute();
    }
    
    public function executeNew (sfWebRequest $request)
    {
        // not used if not necessary
        $this->redirect($this->getController()->genUrl('@homepage'));
        
        
        $this->form = new WorkingHourParameterForm ();
        
        $returnUrl = $this->getController()->genUrl('@whparam_settings_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('WorkingHourParameter')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($this->object);
        
        $this->form = new WHParamSafeForm ($this->object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_settings_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
}
