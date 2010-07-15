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
    $this->enableAdditionalModules();
  }

  /**
   * Enables additional plugin modules
   *
   * @return void
   */
  protected function enableAdditionalModules()
  {
    $this->enabledModules = sfConfig::get('sf_enabled_modules');
    // fix for cc (and may be some other console tasks)
    $this->enabledModules = (null===$this->enabledModules)? array() : $this->enabledModules;

    if ($this->isModuleEnabled('ikCatalogueItemAdmin'))
    {
      $this->enableModule('ikCatalogueCategoryAdmin');
    }
    sfConfig::set('sf_enabled_modules', $this->enabledModules);
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
