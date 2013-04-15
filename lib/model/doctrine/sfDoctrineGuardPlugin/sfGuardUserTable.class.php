<?php

class sfGuardUserTable extends PluginsfGuardUserTable
{    
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardUser');
    }
    
    public function getActive ()
    {
        return $this->CreateQuery('u')
            ->addWhere('u.is_active = ?', true)
            ->execute();
    }
    
    public function getCurrentUsersDepartment ()
    {
        $loggedInUser = sfContext::getInstance()->getUser()->getGuardUser() ;
        $department = $loggedInUser->getManagedDepartment();
        
        return $this
            ->createQuery ('u')
            ->addWhere ('u.group_id = ?', $department->getId())
            ->execute();
    }
    
}
