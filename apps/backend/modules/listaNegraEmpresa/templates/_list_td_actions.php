<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'listaNegraEmpresa/show?id='.$empresa->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_featured">
      <?php if($empresa->getFeatured()):?>
      <?php echo link_to(__('Quitar home', array(), 'messages'), 'listaNegraEmpresa/removeFeatured?id='.$empresa->getId(), array('class' => 'remove')) ?>
      <?php else:?>
      <?php echo link_to(__('Home', array(), 'messages'), 'listaNegraEmpresa/setFeatured?id='.$empresa->getId(), array('class' => 'featured')) ?>
      <?php endif;?>
      
    </li>
    <li class="sf_admin_action_featured_order">
      <?php echo link_to(__('Orden home', array(), 'messages'), 'listaNegraEmpresa/setFeaturedOrder?id='.$empresa->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($empresa, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($empresa, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
