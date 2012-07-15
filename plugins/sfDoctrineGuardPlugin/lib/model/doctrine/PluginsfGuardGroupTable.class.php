<?php

abstract class PluginsfGuardGroupTable extends Doctrine_Table {
    
    public function getOrdered() {
        
        return $this->CreateQuery ('gr')
            ->orderBy ('gr.name ASC')
            ->execute();
        
    }
    
}
