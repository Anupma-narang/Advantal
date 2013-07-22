<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'concurso/show?id=' . $concurso->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_featured">

      <?php if (!$concurso->getFeatured()): ?>
        <?php echo link_to(__('Home', array(), 'messages'), 'concurso/setFeatured?id=' . $concurso->getId(), array('class' => 'featured')) ?>
      <?php else: ?>
        <?php echo link_to(__('Quitar home', array(), 'messages'), 'concurso/removeFeatured?id=' . $concurso->getId(), array('class' => 'remove')) ?>
      <?php endif; ?>
    </li>
    <li class="sf_admin_action_featured_order">
      <?php if ($concurso->getEmpresaId()): ?>
        <?php echo link_to(__('Orden home', array(), 'messages'), 'concurso/setCompanyFeaturedOrder?id=' . $concurso->getId(), array()) ?>
      <?php else: ?>
        <?php echo link_to(__('Orden home', array(), 'messages'), 'concurso/setProductFeaturedOrder?id=' . $concurso->getId(), array()) ?>
      <?php endif; ?>

    </li>
    <?php echo $helper->linkToEdit($concurso, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($concurso, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
  </ul>
</td>
