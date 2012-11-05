<?php

abstract class BaseWHParam_LeaveLimitActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable ('sfGuardUser')
            ->createQuery ('q')
            ->orderBy ('first_name, last_name ASC')
            ->execute();
        
        $this->leavetypes = Doctrine::getTable ('LeaveType')
            ->createQuery ('q')
            ->orderBy ('name ASC')
            ->execute();
    }
}


/*
<?php

abstract class BaseWHParam_HolidayActions extends sfActions
{
    
    
    public function executeNew (sfWebRequest $request)
    {
        $object = new Holiday();
        $object->setDay(date('Y-m-d'));
        $this->form = new HolidayFormRecord ($object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_holiday_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->object = Doctrine::getTable('Holiday')->findOneById($request->getParameter('id'));
        $this->forward404Unless ($this->object);
        
        $this->form = new HolidayFormRecord ($this->object);
        
        $returnUrl = $this->getController()->genUrl('@whparam_holiday_list');
        $processClass = new FmcCoreProcess();
        $processClass->form ($this->form, $request, $returnUrl);
    }
    
}

*/
