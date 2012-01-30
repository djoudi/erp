<?php

/**
 * PluginCostForm form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCostFormForm extends BaseCostFormForm
{
  public function configure()
  {
    # setting Currency
    $curDefault = Doctrine::getTable('Currency')->findOneByisDefault(true)->id;
    $this->setDefault('currency_id', $curDefault);
    
  }
}
