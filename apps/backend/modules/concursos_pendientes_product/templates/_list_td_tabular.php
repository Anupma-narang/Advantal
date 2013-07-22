<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('concursos_pendientes_product/created_at', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resumename">
  <?php echo $concurso->getResumename() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_producto">
  <?php echo get_partial('concursos_pendientes_product/producto', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_marca">
  <?php echo get_partial('concursos_pendientes_product/marca', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
  <?php echo get_partial('concursos_pendientes_product/modelo', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
  <?php echo get_partial('concursos_pendientes_product/sector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subsector">
  <?php echo get_partial('concursos_pendientes_product/subsector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_actividad">
  <?php echo get_partial('concursos_pendientes_product/actividad', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_categoria">
  <?php echo $concurso->getConcursoCategoria() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
  <?php echo $concurso->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
  <?php echo $concurso->getConcursoEstado() ?>
</td>
