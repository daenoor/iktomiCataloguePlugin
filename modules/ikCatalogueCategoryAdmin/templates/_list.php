<?php
//TODO: Move this code to helper
function renderBranch($branch)
{
  foreach ($branch as $node)
  {
    echo '<li id="node-' . $node->getId() . '"><span>' . $node->getName() . '</span>';
    if (count($node->__children))
    {
      echo '<ul>';
      renderBranch($node->__children);
      echo '</ul>';
    }
    echo '</li>';
  }
}
?>

<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array( ), 'sf_admin') ?></p>
  <?php else: ?>
    <ul id="category-branch">
      <?php renderBranch($pager->getResults()) ?>
    </ul>
  <?php endif; ?>
</div>
<script type="text/javascript">
  /* <![CDATA[ */
  function checkAll()
  {
    var boxes = document.getElementsByTagName('input');
    for (var index = 0; index < boxes.length; index++)
    {
      box = boxes[index];
      if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked
    }
    return true;
  }
  /* ]]> */
</script>