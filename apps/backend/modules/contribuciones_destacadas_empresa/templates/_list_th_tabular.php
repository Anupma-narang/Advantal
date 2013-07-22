<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resumename" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_destacado">
    <?php if ('destacado' == $sort[0]): ?>
        <?php echo link_to(__('Destacada', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=destacado&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Destacada', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=destacado&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "concurso") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "concurso")): ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=concurso')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=concurso')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_empresa" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "empresa") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "empresa")): ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=empresa')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=empresa')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_provincia" style="width: 176px;">
    <span class="block" style="width: 176px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "provincia") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "provincia")): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=provincia')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=provincia')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_localidad" style="width: 176px;">
    <span class="block" style="width: 176px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "localidad") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "localidad")): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=localidad')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=localidad')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 176px;">
    <span class="block" style="width: 176px;">
        <?php if ('user_id' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_contribucion_estado">
    <?php if ('contribucion_estado_id' == $sort[0]): ?>
        <?php echo link_to(__('Estado contribución', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=contribucion_estado_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado contribución', array(), 'messages'), '@contribucion_contribuciones_destacadas_empresa', array('query_string' => 'sort=contribucion_estado_id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>