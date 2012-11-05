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
}
