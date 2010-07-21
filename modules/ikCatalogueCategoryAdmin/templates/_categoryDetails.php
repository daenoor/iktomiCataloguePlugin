<div id="category-details">
  <?php if ($categoryPath): ?>
    <span class="category-breadcrumb">      
    <?php foreach ($categoryPath as $pathItem): ?>
      <a href="<?php echo url_for('@catalogue_item') ?>?page=1&category=<?php echo $pathItem['id'] ?>"><?php echo $pathItem['name'] ?></a>&nbsp;&gt;&nbsp;
    <?php endforeach ?>
    </span>
  <?php endif ?>
  <?php if ($category): ?>
    <span class="category-title"><?php echo $category['name'] ?></span>      
  <?php endif ?>
</div>