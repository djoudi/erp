<?php

class form_plugin_currency_add   extends PluginCurrencyForm
{
  public function configure()
  {
    unset($this['isDefault']);
  }
}
