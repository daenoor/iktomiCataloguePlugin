<?php

require_once dirname(__FILE__).'/ikCatalogueItemAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/ikCatalogueItemAdminGeneratorHelper.class.php';

/**
 * Base actions for the iktomiCataloguePlugin ikCatalogueItemAdmin module.
 * 
 * @package     iktomiCataloguePlugin
 * @subpackage  ikCatalogueItemAdmin
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseikCatalogueItemAdminActions extends autoIkCatalogueItemAdminActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $category = $request->getParameter('category', '');
    var_dump($category);
    // auto generated index
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
}
