<?php use_helper('I18N') ?>
<?php if ($category): ?>
  <div id="category-details">
    <ul class="sf_admin_td_actions" id="category-details-actions">
      <li class="sf_admin_action_edit">
        <?php echo link_to(__('Edit', array(), 'sf_admin'), '@catalogue_category_edit?id='.$category['id']) ?>
      </li>
      <li class="sf_admin_action_delete">
        <?php echo link_to(
          __('Delete', array(), 'sf_admin'),
          '@catalogue_category_delete?id='.$category['id'], $category,
          array('method' => 'delete', 'confirm' => __('Are you sure?'))
        ) ?>
      </li>
      <?php if (sfConfig::get('app_catalogue_use_properties')): ?>
        <li class="sf_admin_action_edititemproperties">
          <?php echo link_to(__('Редактировать набор свойств', array(), 'messages'), 'ikCatalogueCategoryAdmin/ListEditCategoryPropertySets?id='.$category['id'], array()) ?>
        </li>
      <?php endif ?>
    </ul>
    <?php if ($categoryPath): ?>
      <span class="category-breadcrumb">
      <?php foreach ($categoryPath as $pathItem): ?>
        <a href="<?php echo url_for('@catalogue_item') ?>?page=1&category=<?php echo $pathItem['id'] ?>"><?php echo $pathItem['name'] ?></a>&nbsp;&gt;&nbsp;
      <?php endforeach ?>
      </span>
    <?php endif ?>
    <span class="category-title"><?php echo $category['name'] ?></span>
    <?php if ($category['description']): ?>
      <p class="category-details-description"><?php echo $category['description'] ?></p>
    <?php endif ?>
  </div>
<?php endif ?>  