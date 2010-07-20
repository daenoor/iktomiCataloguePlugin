<?php
//TODO: Move this code to helper
function renderTree($tree)
{
  foreach ($tree as $node)
  {
    echo '<li id="node-' . $node->getId() . '" class="categories-tree-node"><span class="categories-tree-node-label">' . $node->getName() . '</span>';
    if (count($node->__children))
    {
      echo '<ul>';
      renderTree($node->__children);
      echo '</ul>';
    }
    echo '</li>';
  }
}
?>
<div id="categories-panel">
  <?php if(!empty($tree)): ?>
    <ul id="categories-tree">
      <li class="categories-tree-node" id="node-0"><span class="categories-tree-node-label">Все категории</<span></li>
      <?php renderTree($tree) ?>
    </ul>
  <?php endif ?>
</div>
