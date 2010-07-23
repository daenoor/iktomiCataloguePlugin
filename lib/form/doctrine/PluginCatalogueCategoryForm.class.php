<?php

/**
 * PluginCatalogueCategory form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCatalogueCategoryForm extends BaseCatalogueCategoryForm
{
  protected $parentId = null;

  public function setup()
  {
    parent::setup();

    $this->widgetSchema['parent_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CatalogueCategory',
      'add_empty' => '~ (Объект на верхнем уровне)',
      'order_by' => array('root_id, lft', ''),
      'method' => 'getIndentedName'
    ));
    $this->validatorSchema['parent_id'] = new sfValidatorDoctrineChoice(array(
      'required' => false,
      'model' => 'CatalogueCategory'
    ));
    $this->widgetSchema['property_sets_list'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CataloguePropertySet',
      'multiple' => true,
      'expanded' => true
    ));
    $this->setDefault('parent_id', $this->object->getParentId());
    $this->widgetSchema->setLabel('parent_id', 'Child of');
    
    unset($this['root_id'], $this['lft'], $this['rgt'], $this['level']);
    if (!sfConfig::get('app_catalogue_use_properties')){
      unset($this['property_sets_list']);
    }
    $this->widgetSchema->moveField('slug', sfWidgetFormSchema::AFTER, 'name');
  }

  public function updateParentIdColumn($parentId)
  {
    $this->parentId = $parentId;
    return $parentId;
  }

  protected function doSave($conn = null)
  {
    parent::doSave($conn);

    $node = $this->object->getNode();
    if ($this->parentId != $this->object->getParentId() || !$node->isValidNode())
    {
      if (empty($this->parentId))
      {
        //save as a root
        if ($node->isValidNode())
        {
          $node->makeRoot($this->object['id']);
          $this->object->save($conn);
        }
        else
        {
          $this->object->getTable()->getTree()->createRoot($this->object); //calls $this->object->save internally
        }
      }
      else
      {
        //form validation ensures an existing ID for $this->parentId
        $parent = $this->object->getTable()->find($this->parentId);
        $method = ($node->isValidNode()? 'move' : 'insert') . 'AsLastChildOf';
        $node->$method($parent); //calls $this->object->save internally
      }
    }
  }
}
