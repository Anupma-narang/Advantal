<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to(__('Ver', array(), 'messages'), 'cartas_recomendacion/show?id='.$profesional_letter->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_edit">
      <?php echo link_to(__('Editar', array(), 'messages'), url_for('@profesional_cartas_recomendacion_create?id='.$profesional_letter->getProfesionalId().'&letter_id='.$profesional_letter->getId()), array()) ?>
    </li>
    <?php //echo $helper->linkToEdit($profesional_letter, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($profesional_letter, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
