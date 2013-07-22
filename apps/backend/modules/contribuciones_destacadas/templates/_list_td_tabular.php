<?php $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('contribuciones_destacadas.filtering_estados_tipos', '', 'admin_module'); ?>
<td class="sf_admin_date sf_admin_list_td_created_at">
    <?php echo get_partial('contribuciones_destacadas/created_at', array('type' => 'list', 'contribucion' => $contribucion)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_resumename">
    <?php echo $contribucion->getResumename() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_destacado">
    <?php echo get_partial('contribuciones_destacadas/list_field_boolean', array('value' => $contribucion->getDestacado())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_concurso">
    <?php echo $contribucion->getConcurso() ?>
</td>
<?php if ($filtering_estados_tipos == ""): ?>
    <td class="sf_admin_text sf_admin_list_td_tipo_concurso">
        <?php echo $contribucion->getTipoConcurso() ?>
    </td>
<?php endif; ?>
<?php if ($filtering_estados_tipos == "empresa_entidad"): ?>
    <td class="sf_admin_text sf_admin_list_td_empresa">
        <?php echo get_partial('contribuciones_destacadas/empresa', array('type' => 'list', 'contribucion' => $contribucion)) ?>
    </td>
    <td class="sf_admin_text sf_admin_list_td_provincia">
        <?php echo get_partial('contribuciones_destacadas/provincia', array('type' => 'list', 'contribucion' => $contribucion)) ?>
    </td>
    <td class="sf_admin_text sf_admin_list_td_localidad">
        <?php echo get_partial('contribuciones_destacadas/localidad', array('type' => 'list', 'contribucion' => $contribucion)) ?>
    </td>
<?php endif; ?>
<?php if ($filtering_estados_tipos == "producto"): ?>
    <td class="sf_admin_text sf_admin_list_td_concurso_producto">
        <?php echo $contribucion->getConcursoProducto() ?>
    </td>
    <td class="sf_admin_text sf_admin_list_td_concurso_producto_marca">
        <?php echo $contribucion->getConcursoProductoMarca() ?>
    </td>
    <td class="sf_admin_text sf_admin_list_td_modelo">
        <?php echo get_partial('contribuciones_destacadas/modelo', array('type' => 'list', 'contribucion' => $contribucion)) ?>
    </td>
<?php endif; ?>
<td class="sf_admin_text sf_admin_list_td_username">
    <?php echo $contribucion->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_contribucion_estado">
    <?php echo $contribucion->getContribucionEstado() ?>
</td>
