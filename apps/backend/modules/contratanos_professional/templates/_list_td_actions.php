<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_ver">
      <?php echo link_to(__('Ver', array(), 'messages'), 'contratanos_professional/show?id='.$contratanos->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($contratanos, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($contratanos, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <li class="sf_admin_action_processed">
      <?php echo link_to(__('Tramitado', array(), 'messages'), 'contratanos_professional/processed?id='.$contratanos->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_closed">
      <?php echo link_to(__('Cerrado', array(), 'messages'), 'contratanos_professional/closed?id='.$contratanos->getId(), array()) ?>
    </li>
  </ul>
</td>
