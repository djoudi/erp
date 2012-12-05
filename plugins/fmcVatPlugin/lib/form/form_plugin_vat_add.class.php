<?php

/**
 * Vat form.
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class form_plugin_vat_add   extends PluginVatForm
{
  public function configure()
  {
  	
  	parent::configure();
  	
    $this->widgetSchema['rate'] = new sfWidgetFormInputText();
    $this->validatorSchema['rate'] = new sfValidatorInteger();
    unset($this['isDefault']);
  }
}
