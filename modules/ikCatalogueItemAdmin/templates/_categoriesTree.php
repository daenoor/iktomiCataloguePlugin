<?php
//TODO: Move this code to helper
function renderTree($tree)
{
  foreach ($tree as $node)
  {
    echo '<li id="node-' . $node->getId() . '"><span>' . $node->getName() . '</span>';
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
      <?php renderTree($tree) ?>
    </ul>
  <?php endif ?>
</div>