<?php

class PluginWorkingHourDayTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWorkingHourDay');
    }
    
    
    public function getActiveForUserDate ($user_id, $date)
    {
        $result = $this->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('status <> ?', 'Cancelled')
            ->addWhere ('status <> ?', 'Denied')
            ->fetchOne();
        
        return $result;
    }
}
