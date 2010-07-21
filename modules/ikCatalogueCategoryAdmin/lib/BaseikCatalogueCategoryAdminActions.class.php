<?php

require_once dirname(__FILE__).'/ikCatalogueCategoryAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/ikCatalogueCategoryAdminGeneratorHelper.class.php';
/**
 * Base actions for the iktomiCataloguePlugin ikCatalogueCategoryAdmin module.
 * 
 * @package     iktomiCataloguePlugin
 * @subpackage  ikCatalogueCategoryAdmin
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseikCatalogueCategoryAdminActions extends autoIkCatalogueCategoryAdminActions
{
  public function executeMove(sfWebRequest $request)
  {
    if (!$request->isXmlHttpRequest()){
      throw new RuntimeException('Only Ajax requests allowed');
    }

    $this->getResponse()->setHttpHeader('Content-Type', 'application/json');

    $target = $request->getParameter('target', '');
    $moveType = $request->getParameter('moveType', '');
    if (!$target || !$moveType || !is_numeric($target)){
      return $this->renderText(json_encode(array('status'=>'err')));
    }

    $node = $this->getRoute()->getObject();

    switch($moveType){
      case 'insert':
        $opResult = $node->insertInto($target);
        break;
      case 'next':
        $opResult = $node->moveAfter($target);
        break;
      default:
        return $this->renderText(json_encode(array('status'=>'err')));
    }
    if (!$opResult){
      return $this->renderText(json_encode(array('status'=>'err')));
    } else {
      return $this->renderText(json_encode(array('status'=>'ok')));
    }
  }
}
