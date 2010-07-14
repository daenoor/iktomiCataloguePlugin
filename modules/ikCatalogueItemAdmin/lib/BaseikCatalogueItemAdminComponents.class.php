<?php

/**
 * Base components for the iktomiCataloguePlugin ikCatalogueItemAdmin module.
 *
 * @package     iktomiCataloguePlugin
 * @subpackage  ikCatalogueItemAdmin
 * @author      Daenoor <da3n00r@gmail.com>
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseikCatalogueItemAdminComponents extends sfComponents
{
  public function executeCategoriesTree(sfWebRequest $request)
  {
    $this->tree = Doctrine::getTable('CatalogueCategory')->getTreeHierarchy();
  }
}