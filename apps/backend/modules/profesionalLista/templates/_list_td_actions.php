<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'profesionalLista/show?id=' . $profesional->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_featured">
      <?php if ($profesional->getFeatured()): ?>
        <?php echo link_to(__('Quitar home', array(), 'messages'), 'profesionalLista/removeFeatured?id=' . $profesional->getId(), array('class' => 'remove')) ?>
      <?php else: ?>
        <?php echo link_to(__('Home', array(), 'messages'), 'profesionalLista/setFeatured?id=' . $profesional->getId(), array('class' => 'featured')) ?>
      <?php endif; ?>

    </li>
    <li class="sf_admin_action_featured_order">
      <?php echo link_to(__('Orden home', array(), 'messages'), 'profesionalLista/setFeaturedOrder?id=' . $profesional->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($profesional, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>

    <li class="sf_admin_action_new">
      <?php echo link_to(__('Recomendación', array(), 'messages'), url_for('@profesional_cartas_recomendacion_create?id=' . $profesional->getId()), array()) ?>
    </li>

    <li class="sf_admin_action_new">
      <?php echo link_to(__('Desaprobación', array(), 'messages'), url_for('@profesional_cartas_desaprobacion_create?id=' . $profesional->getId()), array()) ?>
    </li>
    <?php echo $helper->linkToDelete($profesional, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    <li class="sf_admin_action_destacar">
      <?php echo link_to(__('Destacar', array(), 'messages'), 'profesionalLista/destacadoManager?id=' . $profesional->getId(), array()) ?>
    </li>
  </ul>
</td>
