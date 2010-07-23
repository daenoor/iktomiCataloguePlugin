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
  $.post(catalogueCategoryAdmin+'/'+node+'/move', {
    target: target,
    moveType: moveType
  }, callback, 'json');
}

function loadItemsList(url, data){
  $.get(url, data, function(data){
    $('.sf_admin_list').replaceWith(data.list);
    $('.sf_admin_list tbody tr').draggable(itemDragOptions);
    if ($('#sf_admin_content').children().is('#category-details')){
      $('#category-details').replaceWith(data.category_details);
    } else {
      $('#sf_admin_content').prepend(data.category_details);
    }
  });
}

$(document).ready(function(){

  //selecting category if it set in request
  if (!isNaN(reqCategoryId)){
    var categoryNode = 'node-'+reqCategoryId;
    $('#'+categoryNode).addClass('selected');
  }

  // adjusting category tree branches & adding expanders to them
  $('.categories-tree-node ul').each(function(){
    $(this).parent().addClass('categories-tree-branch');
    // $(this).parent().addClass('collapsed');
    $(this).prev('div').prepend('<span class="categories-tree-expander">-</span>')
  });

  // click on branch expander expands/collapses it
  $('.categories-tree-expander').live('click', function(){
    $(this).parent().next('ul').slideToggle('fast').parent().toggleClass('collapsed');
    $(this).text(('+'==$(this).text())?'-':'+');
    return false;
  });

  // click on category label selects it & loads items for it
  $('.categories-tree-node-label').live('click', function(){
    $('.categories-tree-node.selected').removeClass('selected');
    $(this).parent().addClass('selected');
    var categoryId = $(this).parent().attr('id').substring(5);
    loadItemsList(catalogueItemAdmin, {page: 1, category: categoryId});
    return false;
  });

  // adding draggable behavior to categories
  $('.categories-tree-node').draggable(categoryDragOptions);
  //$('.categories-tree-node div').disableSelection();

  // adding draggable behavior to items
  $('.sf_admin_list tbody tr').draggable(itemDragOptions);

  // Ajax items pagination
  $('.sf_admin_pagination a').live('click', (function(e){
    e.preventDefault();
    loadItemsList($(this).attr('href'));
  }));

  // set categories nodes as drop targets for categories

  $('.categories-tree-node > div').droppable({
    accept: '.categories-tree-node, .sf_admin_list tbody tr',
    tolerance: 'pointer',
    drop: function(e, ui){
      if (ui.draggable.hasClass('categories-tree-node')){
        var node = ui.draggable, nodeId = node.attr('id');
        var target = $(this).parent(), targetId = target.attr('id');

        if (e.shiftKey){
          moveCategory(nodeId.substring(5), targetId.substring(5), 'next', function(result){
            if ('ok'===result.status){
              target.after(node);
            }
          })
        } else {
          moveCategory(nodeId.substring(5), targetId.substring(5), 'insert', function(result){
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
      } else {
        var item = ui.draggable, itemId = item.attr('id').substring(5);
        var categoryId = $(this).parent().attr('id').substring(5);
        $.post(catalogueItemAdmin+'/'+itemId+'/move',
          {category: categoryId},
          function(data){
            if ('ok'===data.status){
              // display modal popup here & reload items list
              var categoryId = $('.sf_admin_list').attr('id').substring(14);
              loadItemsList(catalogueItemAdmin, {page: 1, category: categoryId})
            } else {
              // display error modal popup here
            }
        })
      }
    }
  });


  // set categories nodes as drop targets for items
/*
  $('.categories-tree-node > div').droppable({
    accept: '.sf_admin_list tbody tr',
    tolerance: 'pointer',
    drop: function(e, ui){
      var item = ui.draggable, itemId = item.attr('id').substring(5);
      var categoryId = $(this).parent().attr('id').substring(5);
      $.post(catalogueItemAdmin+'/'+itemId+'/move',
        {category: categoryId},
        function(data){
          if ('ok'===data.status){
            // display modal popup here & reload items list
            var categoryId = $('.sf_admin_list').attr('id').substring(14);
            loadItemsList(catalogueItemAdmin, {page: 1, category: categoryId})
          } else {
            // display error modal popup here
          }
      })
    }
  });
*/
});