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
        
}
