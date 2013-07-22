<td class="sf_admin_date sf_admin_list_td_created_at">
    <?php echo get_partial('concursos_pendientes_empresa/created_at', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resumename">
    <?php echo $concurso->getResumename() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_empresa">
    <?php echo get_partial('concursos_pendientes_empresa/empresa', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
    <?php echo get_partial('concursos_pendientes_empresa/sector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subsector">
    <?php echo get_partial('concursos_pendientes_empresa/subsector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_actividad">
    <?php echo get_partial('concursos_pendientes_empresa/actividad', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_provincia">
    <?php echo get_partial('concursos_pendientes_empresa/provincia', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_localidad">
    <?php echo get_partial('concursos_pendientes_empresa/localidad', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<!--<td class="sf_admin_text sf_admin_list_td_concurso_tipo">
<?php //echo $concurso->getConcursoTipo() ?>
</td>-->
<td class="sf_admin_text sf_admin_list_td_concurso_categoria">
    <?php echo $concurso->getConcursoCategoria() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
    <?php echo $concurso->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
    <?php echo $concurso->getConcursoEstado() ?>
</td>
