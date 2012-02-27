<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin'); # login, user, group, permission
    $this->enablePlugins('sfFormExtraPlugin'); # forms
    $this->enablePlugins('sfTaskExtraPlugin'); # extra plugins
    
    $this->enablePlugins('fmcCorePlugin');
    $this->enablePlugins('fmcCurrencyPlugin');
    $this->enablePlugins('fmcCostFormPlugin');
    $this->enablePlugins('fmcCustomerPlugin');
    $this->enablePlugins('fmcEmployeePlugin');
    $this->enablePlugins('fmcProjectPlugin');
    $this->enablePlugins('fmcVatPlugin');
    
  }
  
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    // Enable callbacks so that softDelete behavior can be used
    $manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
  }
}
