<?php

/**
 * iktomiCataloguePlugin configuration.
 *
 * @package     iktomiCataloguePlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class iktomiCataloguePluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  protected $enabledModules = array();

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    //$this->dispatcher->connect('routing.load_configuration', )
    $this->enableAdditionalAdminModules();

    //set up routes
    if ($this->isModuleEnabled('ikCatalogueItemAdmin')){
      $this->dispatcher->connect('routing.load_configuration', array('ikCatalogueRouting', 'addAdminBasicRoutes'));
    }

    if (sfConfig::get('app_catalogue_use_properties')){
      $this->dispatcher->connect('routing.load_configuration', array('ikCatalogueRouting', 'addAdminPropertyRoutes'));
    }

    if ($this->isModuleEnabled('ikCatalogue')){
      $this->dispatcher->connect('routing.load_configuration', array('ikCatalogueRouting', 'addFrontendRoutes'));
    }
  }

  /**
   * Enables additional plugin modules
   *
   * @return void
   */
  protected function enableAdditionalAdminModules()
  {
    $this->enabledModules = sfConfig::get('sf_enabled_modules');
    // fix for cc (and may be some other console tasks)
    $this->enabledModules = (null===$this->enabledModules)? array() : $this->enabledModules;

    if ($this->isModuleEnabled('ikCatalogueItemAdmin'))
    {
      $this->enableModule('ikCatalogueCategoryAdmin');

      if (sfConfig::get('app_catalogue_use_properties'))
      {
        $this->enableModule('ikCataloguePropertyAdmin');
        $this->enableModule('ikCataloguePropertySetAdmin');
      }
      sfConfig::set('sf_enabled_modules', $this->enabledModules);
    }
  }

  /**
   * Checks if module enabled
   *
   * @param  string $moduleName
   * @return bool
   */
  protected function isModuleEnabled($moduleName)
  {
    return in_array($moduleName, $this->enabledModules);
  }

  /**
   * Enables module. If module is already enabled, does nothing
   *
   * @param  $moduleName
   * @return void
   */
  protected function enableModule($moduleName)
  {
    if (!$this->isModuleEnabled($moduleName))
    {
      $this->enabledModules[] = $moduleName;
    }
  }
}
