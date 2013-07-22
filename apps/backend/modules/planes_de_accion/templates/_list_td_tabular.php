<td class="sf_admin_text sf_admin_list_td_concurso_created_at">
  <?php echo get_partial('planes_de_accion/concurso_created_at', array('type' => 'list', 'contribucion' => $contribucion)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resume_name">
  <?php echo $contribucion->getResumeName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resume_concurso">
  <?php echo $contribucion->getResumeConcurso() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_categoria">
  <?php echo $contribucion->getConcursoCategoria() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
  <?php echo $contribucion->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
  <?php echo $contribucion->getConcurso()->getConcursoEstado(); ?>
</td>
