<?php

abstract class PluginProject extends BaseProject
{
    
    public function __toString()
    {
        $result = $this->getCode();
        
        if ($this->getTitle()) $result .= ' -'.$this->getTitle();
        
        return (string) $result;
    }
    
}
