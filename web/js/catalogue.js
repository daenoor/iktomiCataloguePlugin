var itemDragOptions = {
  helper: 'clone',
  opacity: .75,
  refreshPositions: true,
  revert: 'invalid',
  revertDuration: 300,
  scroll: true
};

function moveCategory(source, target, moveType, callback){

}

function moveItemToCategory(item, category, callback){

}

// adding interactions to categories tree
$(document).ready(function(){
  $('li.categories-tree-node ul').each(function(){
    $(this).parent().addClass('categories-tree-branch');
    // $(this).parent().addClass('collapsed');
    $(this).prev('div').prepend('<span class="categories-tree-expander">-</span>')
  });

  $('span.categories-tree-expander').live('click', function(){
    $(this).parent().next('ul').slideToggle('fast').parent().toggleClass('collapsed');
    $(this).text(('+'==$(this).text())?'-':'+');
    return false;
  });

  // Configure categories tree nodes as draggable
  $('.categories-tree-node').draggable(itemDragOptions);

  // Configure catalogue items as draggable
  $('.sf_admin_list tbody tr').draggable(itemDragOptions);
});


