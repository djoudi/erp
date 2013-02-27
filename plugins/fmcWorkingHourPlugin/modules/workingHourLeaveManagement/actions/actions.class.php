<?php

class workingHourLeaveManagementActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->resultLimit = 50;
        
        $q = Doctrine::getTable("LeaveRequest")
            ->createQuery ('l')
            ->leftJoin ('l.Employee e')
            ->leftJoin ('l.LeaveType lt')
            ->addWhere ('l.status <> ?', 'Denied')
            ->limit ($this->resultLimit);
        
        $filterClass = new FmcFilter('whFilter_manageleave');
    
        $this->items = $filterClass->initFilterForm($request, $q)->execute();
        
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
    }
    
    public function executeMakedraft (sfWebRequest $request)
    {
        $item = Doctrine::getTable("LeaveRequest")->findOneById($request->getParameter("id"));
        
        $this->forward404Unless ($item);
        
        if ($item["status"] == "Draft")
        {
            $this->getUser()->setFlash("error", "Draft requests cannot be changed to draft!");
        }
        else
        {
            $item->setStatus ("Draft");
            $item->save();
            $this->getUser()->setFlash("success", "Leave request of employee <strong>{$item->getEmployee()}</strong> changed to draft!");
        }
        
        $this->redirect ($request->getReferer());
    }
}
