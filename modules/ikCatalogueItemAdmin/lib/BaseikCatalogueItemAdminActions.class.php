<?php

require_once dirname(__FILE__) . '/ikCatalogueItemAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/ikCatalogueItemAdminGeneratorHelper.class.php';

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
  protected $categories;

  public function executeIndex(sfWebRequest $request)
  {
    $this->categoryId = $request->getParameter('category', '');
    $this->categories = $this->categoryId?Doctrine::getTable('CatalogueCategory')->getListWithDescendants($this->categoryId):'';

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
/*    if ($request->isXmlHttpRequest()){
      sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
      return $this->renderPartial('ikCatalogueItemAdmin/list', array('pager'=>$this->pager, 'sort'=>$this->sort, 'helper'=>$this->helper));
    } else {
      return sfView::SUCCESS;
    }*/
  }

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    $query = Doctrine::getTable('CatalogueItem')->createQuery('a');

    if ($tableMethod)
    {
      $query = Doctrine::getTable('CatalogueItem')->$tableMethod($query);
    }

    $this->addSortQuery($query);
    $this->addCategoryQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  protected function addCategoryQuery(Doctrine_Query $query)
  {
    if (!$this->categories)
    {
      return;
    }

    $query->andWhereIn('category_id', $this->categories);
  }
}
