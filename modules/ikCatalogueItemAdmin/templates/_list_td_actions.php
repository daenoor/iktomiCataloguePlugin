<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($catalogue_item, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($catalogue_item, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php if (sfConfig::get('app_catalogue_use_properties')): ?>
      <li class="sf_admin_action_edititemproperties">
        <?php echo link_to(__('Редактировать свойства', array(), 'messages'), url_for('@catalogue_item_admin').'/ListEditItemProperties?id='.$catalogue_item->getId(), array()) ?>
      </li>
    <?php endif ?>
  </ul>
</td>