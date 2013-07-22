<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'gift/show?id='.$gift->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_featured">
      <?php if($gift->getFeatured()):?>
      <?php echo link_to(__('Quitar Home', array(), 'messages'), 'gift/removeFeatured?id='.$gift->getId(), array('class' => 'remove')) ?>
      <?php else:?>
      <?php echo link_to(__('Home', array(), 'messages'), 'gift/setFeatured?id='.$gift->getId(), array('class' => 'featured')) ?>
      <?php endif;?>
      
    </li>
    <li class="sf_admin_action_featured_order">
      <?php echo link_to(__('Orden Home', array(), 'messages'), 'gift/setFeaturedOrder?id='.$gift->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($gift, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($gift, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
