<?php

/**
 * PluginCataloguePropertySet form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCataloguePropertySetForm extends BaseCataloguePropertySetForm
{
  public function setup()
  {
    parent::setup();

    $this->widgetSchema['properties_list'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CatalogueProperty',
      'multiple' => true,
      'expanded' => true
    ));

    $this->validatorSchema['properties_list'] = new sfValidatorDoctrineChoice(array(
      'required' => false,
      'model' => 'CatalogueProperty',
      'multiple' => true
    ));
  }
}
