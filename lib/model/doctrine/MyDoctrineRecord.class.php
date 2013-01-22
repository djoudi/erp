<?php
 
abstract class MyDoctrineRecord extends sfDoctrineRecord
{
    protected $systemUserId = null;
    
    public function preSave($event)
    {
        if (!$this->getSystemUser())
        {
            if(!sfContext::hasInstance() || get_called_class()=='sfGuardUser')
            {
                $userId = sfConfig::get('default_updater_id');
                $this->setSystemUser($userId);
            }
            else
            {
                $this->setSystemUser(sfContext::getInstance()->getUser()->getGuardUser()->getId());
            }
        }
    }
    
    public function setSystemUser($userId)
    {
        $this->systemUserId = $userId;
    }
    
    public function getSystemUser()
    {
        return $this->systemUserId;
    }
}
?>
