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
  public function setup()
  {
    parent::setup();

    $this->widgetSchema['property_type'] = new sfWidgetFormChoice(array(
      'choices' => array(
        'n' => 'Число', 'm' => 'Измеряемое', 'e' => 'Список',
        's' => 'Строка', 'l' => 'Логическое'
      )
    ));
    $this->widgetSchema['property_value'] = new sfWidgetFormInputText();
    $this->validatorSchema['property_value'] = new sfValidatorPass();

    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
      'callback' => array( $this, 'checkPropertyValueDefault' )
    )));

  }

  public function checkPropertyValueDefault($validator, $values)
  {
    switch ($values['property_type'])
    {
      case 'e':
        // clean every item in array as string
        $variants = is_array($values['property_value'])?$values['property_value']:explode(';', $values['property_value']);
        if (is_array($values['property_value'])){
          $values['property_value'] = join(';', $values['property_value']);
          $this->values['property_value'] = $values['property_value']; 
        }

        $valueValidator = new sfValidatorString();

        $values['property_value'] = $valueValidator->clean($values['property_value']);

        // default must be empty or one of property value variants

        //TODO: Add validation for default value (sfValidatorChoice doesn't suits)
    }
  }

  protected function doSave($con = null)
  {
    var_dump($this->values['property_value']);

    if (is_array($this->values['property_value']))
    {
      $this->values['property_value'] = join(';', $this->values['property_value']);
    }

    parent::save($con);
  }
}
