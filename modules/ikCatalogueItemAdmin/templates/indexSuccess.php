<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ikCatalogueItemAdmin/assets') ?>

<?php use_stylesheet('/iktomiCataloguePlugin/css/catalogue-admin.css') ?>
<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js') ?>
<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Каталог', array(), 'messages') ?></h1>

  <?php include_partial('ikCatalogueItemAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ikCatalogueItemAdmin/list_header', array('pager' => $pager)) ?>
  </div>

  <?php include_component('ikCatalogueCategoryAdmin', 'categoriesTree') ?>
  <div id="sf_admin_content">
    <?php include_partial('ikCatalogueCategoryAdmin/categoryDetails', array('category'=>$category, 'categoryPath'=>$categoryPath)) ?>
    <form action="<?php echo url_for('catalogue_item_admin_collection', array('action' => 'batch')) ?>" method="post">
    <div id="catalogue-items-list">
      <?php include_partial('ikCatalogueItemAdmin/list', array(
        'pager' => $pager, 'sort' => $sort,
        'helper' => $helper, 'category'=>$categoryId,
      )) ?>
    </div>
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

<script type="text/javascript">
  var catalogueCategoryAdmin = '<?php echo url_for('@catalogue_category_admin') ?>';
  var catalogueItemAdmin = '<?php echo url_for('@catalogue_item_admin') ?>';
  var reqCategoryId = '<?php echo $categoryId ?>';

</script>
<script type="text/javascript" src="/iktomiCataloguePlugin/js/catalogue-admin.js"></script>