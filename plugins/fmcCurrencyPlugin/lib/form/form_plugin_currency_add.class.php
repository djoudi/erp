<?php

class form_plugin_currency_add   extends PluginCurrencyForm
{
    
    public function configure()
    {
  	    parent::configure();
        
        unset($this['isDefault']);
    }
    
}
