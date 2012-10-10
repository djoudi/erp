<?php

abstract class PluginWorkType extends BaseWorkType {
    
    public function __toString() {
        
        return (string) $this->getCode()." - ".$this->getTitle();
        
    }
}
