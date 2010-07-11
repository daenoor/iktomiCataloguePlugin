<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('/iktomiCataloguePlugin/css/catalogue.css') ?>
<?php include_partial('ikCatalogueCategoryAdmin/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Каталог', array(), 'messages') ?></h1>

  <?php include_partial('ikCatalogueCategoryAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ikCatalogueCategoryAdmin/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('ikCatalogueCategoryAdmin/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <div id="catalogue">
      <div id="catalogue-categories">
        <?php include_partial('ikCatalogueCategoryAdmin/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
      </div>
      <div id="catalogue-content">
        <div id="catalogue-category">Category detailed will be here</div>
        <div id="catalogue-items">Catalogue items will be here</div>
      </div>
    </div>
    <div id="catalogue-footer">
      <ul class="sf_admin_actions">
        <?php include_partial('ikCatalogueCategoryAdmin/list_batch_actions', array('helper' => $helper)) ?>
        <?php include_partial('ikCatalogueCategoryAdmin/list_actions', array('helper' => $helper)) ?>
      </ul>
    </div>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('ikCatalogueCategoryAdmin/list_footer', array('pager' => $pager)) ?>
  </div>
</div>