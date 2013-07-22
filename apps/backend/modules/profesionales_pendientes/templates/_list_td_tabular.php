<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($profesional->getCreatedAt()) ? format_date($profesional->getCreatedAt(), "dd/MM/y") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_last_name_one">
  <?php echo $profesional->getLastNameOne() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_last_name_two">
  <?php echo $profesional->getLastNameTwo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_first_name">
  <?php echo $profesional->getFirstName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state_name">
  <?php echo $profesional->getStateName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_city_name">
  <?php echo $profesional->getCityName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_profesional_tipo_uno">
  <?php echo $profesional->getProfesionalTipoUno() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_profesional_tipo_dos">
  <?php echo $profesional->getProfesionalTipoDos() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_activity_name">
  <?php echo $profesional->getActivityTres() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
  <?php echo $profesional->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_profesional_estado">
  <?php echo $profesional->getProfesionalEstado() ?>
</td>
