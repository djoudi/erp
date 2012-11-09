<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    
    public function getMyActiveForDate ($date)
    {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        return $this->getActiveForUserDate ($user['id'], $date);
    }
    
    
    public function getActiveForUserDate ($user_id, $date)
    {
        $q = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status <> ?', 'Cancelled')
            ->addWhere ('status <> ?', 'Denied');
        $result = $q->fetchOne();
        return $result;
    }
    
}
