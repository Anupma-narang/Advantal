<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resume_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Contribución', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=resume_name')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Contribución', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=resume_name')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resume_concurso" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=concurso')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=concurso')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_categoria" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=category')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=category')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_empresa" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=empresa')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=empresa')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_provincia" style="width: 176px">
    <span class="block" style="width: 176px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=provincia')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=provincia')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_localidad" style="width: 210px">
    <span class="block" style="width: 210px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=localidad')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=localidad')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_sector">
    <span class="block" style="width: 350px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=sector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=sector')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_subsector">
    <span class="block" style="width: 350px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=subsector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=subsector')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_actividad">
    <span class="block" style="width: 350px">
        <?php if ('concurso_id' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=actividad')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=actividad')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 176px">
    <span class="block" style="width: 176px">
        <?php if ('user_id' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_estado">
    <?php if ('contribucion_estado_id' == $sort[0]): ?>
        <?php echo link_to(__('Estado concurso', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=contribucion_estado_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado concurso', array(), 'messages'), '@contribucion_planes_de_accion_empresa', array('query_string' => 'sort=contribucion_estado_id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>