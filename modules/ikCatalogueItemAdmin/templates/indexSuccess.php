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
    <div id="catalogue-items-list">
      <?php include_partial('ikCatalogueItemAdmin/list', array(
        'pager' => $pager, 'sort' => $sort,
        'helper' => $helper, 'category'=>$categoryId
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
  $(document).ready(function(){
    $('span.categories-tree-node-label').click(function(){
      $('li.categories-tree-node.selected').removeClass('selected');
      $(this).parent().addClass('selected');
      var categoryId = $(this).parent().attr('id').substring(5);
      $('#catalogue-items-list').load('/admin.php/ikCatalogueItemAdmin?category='+categoryId+' .sf_admin_list');
    })

    $('.sf_admin_pagination a').live('click', (function(e){
      e.preventDefault();
      var pagerLink = $(this).attr('href')<?php echo $categoryId?"+'&category="+$categoryId+"'":'' ?>;  
      $('#catalogue-items-list').load(pagerLink+' .sf_admin_list');
    }));
  });
</script>