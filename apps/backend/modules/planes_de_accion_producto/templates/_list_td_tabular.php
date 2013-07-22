<td class="sf_admin_text sf_admin_list_td_concurso_created_at">
    <?php echo get_partial('planes_de_accion_producto/concurso_created_at', array('type' => 'list', 'contribucion' => $contribucion)) ?>
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
<td class="sf_admin_text sf_admin_list_td_concurso_producto">
    <?php echo $contribucion->getConcursoProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_producto_marca">
    <?php echo $contribucion->getConcursoProductoMarca() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
    <?php echo get_partial('planes_de_accion_producto/modelo', array('type' => 'list', 'contribucion' => $contribucion)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_producto_uno">
    <?php echo $contribucion->getConcursoProductoUno() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_producto_dos">
    <?php echo $contribucion->getConcursoProductoDos() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_prod_tipo">
    <?php echo $contribucion->getConcursoProdTipo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
    <?php echo $contribucion->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso_estado">
    <?php echo $contribucion->getConcurso()->getConcursoEstado(); ?>
</td>
