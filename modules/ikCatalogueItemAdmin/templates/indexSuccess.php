<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ikCatalogueItemAdmin/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Каталог', array(), 'messages') ?></h1>

  <?php include_partial('ikCatalogueItemAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ikCatalogueItemAdmin/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <?php include_component('ikCatalogueItemAdmin', 'categoriesTree') ?>
    <form action="<?php echo url_for('catalogue_item_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('ikCatalogueItemAdmin/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('ikCatalogueItemAdmin/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('ikCatalogueItemAdmin/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('ikCatalogueItemAdmin/list_footer', array('pager' => $pager)) ?>
  </div>
</div>