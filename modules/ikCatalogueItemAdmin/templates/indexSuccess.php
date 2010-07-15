<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ikCatalogueItemAdmin/assets') ?>

<?php use_stylesheet('/iktomiCataloguePlugin/css/catalogue.css') ?>
<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js') ?>
<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Каталог', array(), 'messages') ?></h1>

  <?php include_partial('ikCatalogueItemAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ikCatalogueItemAdmin/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <?php include_component('ikCatalogueCategoryAdmin', 'categoriesTree') ?>
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

<script type="text/javascript">
  $(document).ready(function(){
    // marking branches
    $('li.categories-tree-node ul').parent('li').addClass('categories-tree-branch');
    // initial branch state is collapsed
    $('li.categories-tree-branch').addClass('collapsed').prepend('<span class="categories-tree-expander">+</span>')

    $('span.categories-tree-expander').click(function(){
      var node = $(this).parent();
      node.children('ul').slideToggle('fast');
      node.hasClass('collapsed')?node.removeClass('collapsed').addClass('expanded'):
            node.removeClass('expanded').addClass('collapsed');
    })
  });
</script>