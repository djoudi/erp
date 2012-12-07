<?php

class form_plugin_vat_add   extends PluginVatForm
{
    
    public function configure()
    {
        parent::configure();
        
        unset($this['isDefault']);
    }
  
}
