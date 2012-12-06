<?php


class PluginCurrencyTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginCurrency');
    }
    
    public function getActive()
    {
        $q = $this->CreateQuery('c')
            ->where('c.isActive = ?', true);
        
        return $q->execute();
    }
    
}
