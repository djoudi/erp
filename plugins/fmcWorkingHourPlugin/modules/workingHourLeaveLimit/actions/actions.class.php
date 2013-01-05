<?php

class workingHourLeaveLimitActions extends sfActions
{
    
    public function executeList (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable ('sfGuardUser')->findAll();
        
        $this->leaveTypes = Doctrine::getTable ('LeaveType')->findAll();
    }
    
    public function executeEdit (sfWebRequest $request)
    {
        $this->employee = Doctrine::getTable('sfGuardUser')->findOneById($request->getParameter('id'));
        
        $this->forward404Unless ($this->employee);
        
        $this->limits = $this->employee->getLeaveRequestLimit()->toArray();
        
        $this->leaveTypes = Doctrine::getTable('LeaveType')->findAll()->toArray();
        
        if ($request->isMethod('post'))
        {
            foreach ($this->leaveTypes as $type)
            {
                    $currentRecord = Doctrine::getTable ('LeaveRequestLimit')
                        ->getForUserType($this->employee->getId(), $type['id']);
                
                if ($currentRecord['id'])
                {
                    if (!$request->getParameter($type['id']))
                    {
                        $currentRecord->delete();
                    }
                    else
                    {
                        $currentRecord->setLeaveLimit($request->getParameter($type['id']));
                        $currentRecord->save();
                    }
                }
                elseif ($request->getParameter($type['id']))
                {
                    $newRecord = new LeaveRequestLimit();
                    $newRecord->setEmployeeId ($this->employee->getId());
                    $newRecord->setTypeId ($type['id']);
                    $newRecord->setLeaveLimit ($request->getParameter($type['id']));
                    $newRecord->save();
                }
            }
            
            $this->getUser()->setFlash('success', 'Changes saved successfully.');
            
            $this->redirect ($request->getReferer());
            
            #$this->redirect($redirectUrl);
            
        }
    }
    
}
