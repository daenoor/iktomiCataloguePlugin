<?php

/**
 * PluginCatalogueItem form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCatalogueItemForm extends BaseCatalogueItemForm
{
  public function setup(){
    parent::setup();

    unset($this['preview']);

    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
      'is_image'=>'true',
      'file_src'=>'/uploads'.$this->getObject()->getImage(),
      'edit_mode'=>'/uploads'.$this->getObject()->getImage(),
      'delete_label'=>'Удалить',
    ));
    $this->validatorSchema['image'] = new sfValidatorFileImage(array(
      'required'=>false,
      'max_width' => sfConfig::get('app_catalogue_item_image_max_width'),
      'max_height'=> sfConfig::get('app_catalogue_item_image_max_height'),
      'background' => '#ffffff',
      'mime_types' => 'web_images',
    ));

     $this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CatalogueCategory',
      'order_by' => array('root_id, lft', ''),
      'method' => 'getCategoryString',
      'query' => Doctrine::getTable('CatalogueCategory')->getItemEditCategoriesQuery(),
    ));
    $this->validatorSchema['category_id'] = new sfValidatorDoctrineChoice(array(
      'required' => false,
      'model' => 'CatalogueCategory'
    ));
  }
}
