<?php use_helper('CatalogueTree') ?>
<div id="categories-panel">
  <?php if(!empty($tree)): ?>
    <ul id="categories-tree">
      <li class="categories-tree-node" id="node-0"><div class="categories-tree-node-label">Все категории</div></li>
      <?php renderTree($tree) ?>
    </ul>
  <?php endif ?>
  <div id="categories-panel-new">
    <?php echo link_to(__('New', array(), 'sf_admin'), '@catalogue_category_admin_new') ?>
  </div>
</div>
