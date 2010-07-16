<?php

/**
 * PluginCatalogueProperty form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCataloguePropertyForm extends BaseCataloguePropertyForm
{
  public function setup(){
    parent::setup();

    $this->widgetSchema['property_type'] = new sfWidgetFormChoice(array(
      'choices' => array(
        'n' => 'Число', 'm' => 'Измеряемое', 'e' => 'Список',
        's' => 'Строка', 'l' => 'Логическое'
      )  
    ));
  }
}
