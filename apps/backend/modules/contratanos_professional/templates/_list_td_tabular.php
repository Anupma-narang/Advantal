<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('contratanos_professional/created_at', array('type' => 'list', 'contratanos' => $contratanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nombre">
  <?php echo $contratanos->getNombre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_apellido1">
  <?php echo $contratanos->getApellido1() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_apellido2">
  <?php echo $contratanos->getApellido2() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_actividad">
  <?php echo $contratanos->getActividad() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_states_id">
  <?php echo get_partial('contratanos_professional/states_id', array('type' => 'list', 'contratanos' => $contratanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_city_id">
  <?php echo get_partial('contratanos_professional/city_id', array('type' => 'list', 'contratanos' => $contratanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo get_partial('contratanos_professional/status', array('type' => 'list', 'contratanos' => $contratanos)) ?>
</td>
