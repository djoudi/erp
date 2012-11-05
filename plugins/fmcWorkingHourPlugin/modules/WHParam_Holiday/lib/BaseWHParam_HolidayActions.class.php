<?php

abstract class BaseWHParam_HolidayActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        /* TODO: sor: mevcut tarihten sonrakileri göster sadece? */
        
        $this->items = Doctrine::getTable ('Holiday')
            ->createQuery ('q')
            ->orderBy('date ASC')
            ->execute();
        
    }
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new HolidayForm();
        
        $returnUrl = $this->getController()->genUrl('@whparam_holiday_list');
        
        $processClass = new FmcCoreProcess();
        
        $processClass->form ($this->form, $request, $returnUrl);
        
    }
}
