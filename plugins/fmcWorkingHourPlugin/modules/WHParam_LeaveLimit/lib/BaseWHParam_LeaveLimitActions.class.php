<?php

abstract class BaseWHParam_LeaveLimitActions extends sfActions
{
    public function executeList (sfWebRequest $request)
    {
        $this->employees = Doctrine::getTable ('sfGuardUser')
            ->createQuery ('q')
            ->orderBy ('first_name, last_name ASC')
            ->execute();
            
        $this->leaveTypes = Doctrine::getTable ('LeaveType')
            ->createQuery ('q')
            ->orderBy ('name ASC')
            ->fetchArray();
    }
    
    public function executeEdituser (sfWebRequest $request)
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
                    ->createQuery ('q')
                    ->addWhere ('user_id = ?', $this->employee->getId())
                    ->addWhere ('type_id = ?', $type['id'])
                    ->fetchOne();
                if ($currentRecord['id'])
                {
                    $currentRecord->setLeaveLimit($request->getParameter($type['id']));
                    $currentRecord->save();
                }
                elseif ($request->getParameter($type['id']))
                {
                    $newRecord = new LeaveRequestLimit();
                    $newRecord->setUserId ($this->employee->getId());
                    $newRecord->setTypeId ($type['id']);
                    $newRecord->setLeaveLimit ($request->getParameter($type['id']));
                    $newRecord->save();
                }
            }
            
            $this->getUser()->setFlash('success', 'Changes saved successfully.');
            $this->redirect($this->getController()->genUrl("@whparam_leavelimit_edituser?id=".$this->employee->getId()));
            
        }
    }
}
