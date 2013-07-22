<td class="sf_admin_text sf_admin_list_td_concurso_created_at">
    <?php echo get_partial('planes_de_accion_empresa/concurso_created_at', array('type' => 'list', 'contribucion' => $contribucion)) ?>
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
<td class="sf_admin_text sf_admin_list_td_concurso_empresa">
    <?php echo $contribucion->getConcursoEmpresa() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_sector">
    <?php echo $contribucion->getConcursoSector() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_subsector">
    <?php echo $contribucion->getConcursoSubsector() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_actividads">
    <?php echo $contribucion->getConcursoActividads() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_provincia">
    <?php echo get_partial('planes_de_accion_empresa/provincia', array('type' => 'list', 'contribucion' => $contribucion)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_localidad">
    <?php echo get_partial('planes_de_accion_empresa/localidad', array('type' => 'list', 'contribucion' => $contribucion)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
    <?php echo $contribucion->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
    <?php echo $contribucion->getConcurso()->getConcursoEstado(); ?>
</td>
