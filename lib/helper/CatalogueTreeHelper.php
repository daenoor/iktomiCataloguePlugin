<?php

function renderTree($tree)
{
  foreach ($tree as $node)
  {
    echo '<li id="node-' . $node->getId() . '" class="categories-tree-node"><div class="categories-tree-node-label">' . $node->getName() . '</div>';
    if (count($node->__children))
    {
      echo '<ul>';
      renderTree($node->__children);
      echo '</ul>';
    }
    echo '</li>';
  }
} 