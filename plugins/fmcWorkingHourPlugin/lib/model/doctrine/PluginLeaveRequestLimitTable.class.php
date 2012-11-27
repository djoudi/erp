<?php

class PluginLeaveRequestLimitTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginLeaveRequestLimit');
    }
    
    public function getForUserType ($user_id, $type_id)
    {
        $q = $this->createQuery ('l')
            ->addWhere ('user_id = ?', $user_id)
            ->addWhere ('type_id = ?', $type_id);
        return $q->fetchOne();
    }
    
}
