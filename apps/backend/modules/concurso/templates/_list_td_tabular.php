<?php 
    $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');
?>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('concurso/created_at', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resumename">
  <?php echo $concurso->getResumename() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tipodestacado">
  <?php echo get_partial('concurso/tipodestacado', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_tipo">
  <?php echo $concurso->getConcursoTipo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_categoria">
  <?php echo $concurso->getConcursoCategoria() ?>
</td>
<?php if($filtering_estados_tipos == "empresa_entidad"):?> 
<td class="sf_admin_text sf_admin_list_td_empresa">
  <?php echo get_partial('concurso/empresa', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
  <?php echo get_partial('concurso/sector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subsector">
  <?php echo get_partial('concurso/subsector', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_actividad">
  <?php echo get_partial('concurso/actividad', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_provincia">
  <?php echo get_partial('concurso/provincia', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_localidad">
  <?php echo get_partial('concurso/localidad', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<?php endif ?>
<?php if($filtering_estados_tipos == "producto"):?> 
<td class="sf_admin_text sf_admin_list_td_producto">
  <?php echo get_partial('concurso/producto', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_marca">
  <?php echo get_partial('concurso/marca', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
  <?php echo get_partial('concurso/modelo', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector_del_producto">
  <?php echo get_partial('concurso/sector_del_producto', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subsector_del_producto">
  <?php echo get_partial('concurso/subsector_del_producto', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tipo_de_producto">
  <?php echo get_partial('concurso/tipo_de_producto', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<?php endif ?>
<td class="sf_admin_text sf_admin_list_td_username">
  <?php echo $concurso->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
  <?php echo $concurso->getConcursoEstado() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_featured">
  <?php echo get_partial('concurso/featured', array('type' => 'list', 'concurso' => $concurso)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_featured_order">
  <?php echo $concurso->getFeaturedOrder() ?>
</td>
