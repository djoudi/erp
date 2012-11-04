<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    
    /* For Lucene Search */
    
    static protected $zendAutoloader = false;
    static public function registerZend()
    {
        if (!self::$zendAutoloader) {
            set_include_path(implode(
                PATH_SEPARATOR, array(
                sfConfig::get('sf_lib_dir') . '/vendor', 
                get_include_path(),
            )));
            require_once 'Zend/Loader/Autoloader.php';
            self::$zendAutoloader = 
                Zend_Loader_Autoloader::getInstance();
        }
        return self::$zendAutoloader;
    }
            

    
    
  public function setup()
  {
    
    $this->enablePlugins('ioMenuPlugin');
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
    $this->enablePlugins('fmcWorkingHourPlugin');
    
  }
  
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    // Enable callbacks so that softDelete behavior can be used
    $manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
    
    
    /* SYMFONY SNIPPET 405 - AUDITABLE */    
        // use a custom base class that has the system user methods used for updating
        // the creater and updater.
        $options = array('baseClassName' => 'MyDoctrineRecord');
        sfConfig::set('doctrine_model_builder_options', $options);
        // user id that is used when no logged in user is present. This is required
        // to be able to load fixtures.
        sfConfig::set('default_updater_id',1);
     
     // BURASI DA DEGISTIRILECEK
     
     
  }
}
