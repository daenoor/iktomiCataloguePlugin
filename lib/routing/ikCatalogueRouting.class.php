<?php

class ikCatalogueRouting
{
  static public function addAdminBasicRoutes(sfEvent $event){
    /** @var sfPatternRouting $routing  */
    $routing = $event->getSubject();

    $routing->prependRoute('catalogue_category_move', new sfDoctrineRoute('/catalogue/category/:id/move',
      array('module'=>'ikCatalogueCategoryAdmin', 'action'=>'move'),
      array('id'=>'\d+', 'sf_method'=>'post'),
      array('model'=>'CatalogueCategory', 'type'=>'object')
    ));

    $routing->prependRoute('catalogue_category_admin', new sfDoctrineRouteCollection(array(
      'name'=>'catalogue_category_admin',
      'model'=>'CatalogueCategory',
      'module'=>'ikCatalogueCategoryAdmin',
      'prefix_path'=>'/catalogue/category',
      'column'=>'id',
      'with_wildcard_routes'=>true
    )));

    $routing->prependRoute('catalogue_item_move', new sfDoctrineRoute('/catalogue/:id/move',
      array('module'=>'ikCatalogueItemAdmin', 'action'=>'move'),
      array('id'=>'\d+', 'sf_method'=>'post'),
      array('model'=>'CatalogueItem', 'type'=>'object')
    ));

    $routing->prependRoute('catalogue_item_admin', new sfDoctrineRouteCollection(array(
      'name'=>'catalogue_item_admin',
      'model'=>'CatalogueItem',
      'module'=>'ikCatalogueItemAdmin',
      'prefix_path'=>'/catalogue',
      'column'=>'id',
      'with_wildcard_routes'=>true
    )));
  }

  static public function addAdminPropertyRoutes(sfEvent $event){
    /** @var sfPatternRouting $routing  */
    $routing = $event->getSubject();

    $routing->prependRoute('catalogue_property_set_admin', new sfDoctrineRouteCollection(array(
      'name'=>'catalogue_property_set_admin',
      'model'=>'CataloguePropertySet',
      'module'=>'ikCataloguePropertySetAdmin',
      'prefix_path'=>'/catalogue/property-set',
      'column'=>'id',
      'with_wildcard_routes'=>true
    )));

    $routing->prependRoute('catalogue_property_admin', new sfDoctrineRouteCollection(array(
      'name'=>'catalogue_property_admin',
      'model'=>'CatalogueProperty',
      'module'=>'ikCataloguePropertyAdmin',
      'prefix_path'=>'/catalogue/property',
      'column'=>'id',
      'with_wildcard_routes'=>true
    )));
  }

  static public function addFrontendRoutes(sfEvent $event){

  }
}