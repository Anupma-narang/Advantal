<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'productoListaBlanca/show?id=' . $producto->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_featured">
      <?php if ($producto->getFeatured()): ?>
        <?php echo link_to(__('Quitar home', array(), 'messages'), 'productoListaBlanca/removeFeatured?id=' . $producto->getId(), array('class' => 'remove')) ?>
      <?php else: ?>
        <?php echo link_to(__('Home', array(), 'messages'), 'productoListaBlanca/setFeatured?id=' . $producto->getId(), array('class' => 'featured')) ?>
      <?php endif; ?>

    </li>
    <li class="sf_admin_action_featured_order">
      <?php echo link_to(__('Orden home', array(), 'messages'), 'productoListaBlanca/setFeaturedOrder?id=' . $producto->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($producto, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($producto, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    <li class="sf_admin_action_destacar">
      <?php echo link_to(__('Destacar', array(), 'messages'), 'productoListaBlanca/destacadoManager?id=' . $producto->getId(), array()) ?>
    </li>
  </ul>
</td>
