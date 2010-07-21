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
  var categoryDragOptions = {
    helper: 'clone',
    opacity: .75,
    revert: 'invalid',
    revertDuration: 300
  };
  
  var itemDragOptions = {
    helper: 'clone',
    opacity: .75,
    //refreshPositions: true,
    revert: 'invalid',
    revertDuration: 300,
    scroll: true
  };

  function moveCategory(node, target, moveType, callback){
    /*$.post('<?php echo url_for('@catalogue_category') ?>/'+node+'/move', {
      target: target,
      moveType: moveType
    }, callback, 'json');*/
    alert(target);
  }

  $(document).ready(function(){
    // adjusting category tree branches & adding expanders to them
    $('li.categories-tree-node ul').each(function(){
      $(this).parent().addClass('categories-tree-branch');
      // $(this).parent().addClass('collapsed');
      $(this).prev('div').prepend('<span class="categories-tree-expander">-</span>')
    });

    // click on branch expander expands/collapses it
    $('span.categories-tree-expander').live('click', function(){
      $(this).parent().next('ul').slideToggle('fast').parent().toggleClass('collapsed');
      $(this).text(('+'==$(this).text())?'-':'+');
      return false;
    });

    // click on category label selects it & loads items for it
    $('div.categories-tree-node-label').live('click', function(){
      $('li.categories-tree-node.selected').removeClass('selected');
      $(this).parent().addClass('selected');
      var categoryId = $(this).parent().attr('id').substring(5);
      //$('#catalogue-items-list').load('/admin.php/ikCatalogueItemAdmin?category='+categoryId+' .sf_admin_list');
      $('#catalogue-items-list').load('<?php echo url_for('@catalogue_item') ?>?page=1&category='+categoryId+' .sf_admin_list', function(){
        $('.sf_admin_list tbody tr').draggable(itemDragOptions);
      });
      return false;
    });

    // adding draggable behavior to categories
    $('.categories-tree-node').draggable(categoryDragOptions);
    $('.categories-tree-node div').disableSelection();

    // adding draggable behavior to items
    $('.sf_admin_list tbody tr').draggable(itemDragOptions);

    // Ajax items pagination
    $('.sf_admin_pagination a').live('click', (function(e){
      e.preventDefault();
      var pagerLink = $(this).attr('href')<?php echo $categoryId?"+'&category="+$categoryId+"'":'' ?>;
      $('#catalogue-items-list').load(pagerLink+' .sf_admin_list', function(){
        $('.sf_admin_list tbody tr').draggable(itemDragOptions);
      });
    }));

    // set categories nodes as drop targets for categories
    $('.categories-tree-node > div').droppable({
      accept: '.categories-tree-node',
      tolerance: 'pointer',
      drop: function(e, ui){
        var node = ui.draggable, nodeId = node.attr('id');
        var target = $(this).parent(), targetId = target.attr('id');

        if (e.shiftKey){
          moveCategory(nodeId.substring(5), targetId.substring(5), 'next', function(result){
            if ('ok'===result.status){
              target.after(node);
            }
          })
        } else {
          moveCategory(nodeId.substring(5), targetId.substring(5), 'next', function(result){
            if ('ok'===result.status){
              if (target.hasClass('categories-tree-branch')){
                target.children('ul').prepend(node);
              } else {
                target.addClass('categories-tree-branch').append('<ul>')
                    .children('div').prepend('<span class="categories-tree-expander">-</span>');
                target.children('ul').append(node);
              }
            }
          })
        }
      }
    });
  })
</script>