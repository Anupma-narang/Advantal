<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resume_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "resume_name") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "resume_name")): ?>
            <?php echo link_to(__('Contribución', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=resume_name')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Contribución', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=resume_name')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resume_concurso" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "concurso") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "concurso")): ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=concurso')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Concurso', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=concurso')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_categoria" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "category") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "category")): ?>      
            <?php echo link_to(__('Categoría', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=category')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=category')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_producto" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "producto") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "producto")): ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=producto')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=producto')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_producto_marca" style="width: 350px">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "marca") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "marca")): ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=marca')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=marca')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo">
    <span class="block" style="width: 141px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "modelo") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "modelo")): ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=modelo')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=modelo')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_producto_tipo" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "sector") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "sector")): ?>      
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=sector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=sector')) ?>
        <?php endif; ?>  
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_producto_tipo" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "subsector") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "subsector")): ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=subsector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=subsector')) ?>
        <?php endif; ?>  
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_producto_tipo" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if (('concurso_id' == $sort[0] && $sf_request->hasParameter("columname") && $sf_request->getParameter("columname") == "tipodeproducto") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "tipodeproducto")): ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columname=tipodeproducto')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=concurso_id&sort_type=asc&columname=tipodeproducto')) ?>
        <?php endif; ?>  
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 176px">
    <span class="block" style="width: 176px">
        <?php if ('user_id' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_estado">
    <?php if ('contribucion_estado_id' == $sort[0]): ?>
        <?php echo link_to(__('Estado concurso', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=contribucion_estado_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado concurso', array(), 'messages'), '@contribucion_planes_de_accion_producto', array('query_string' => 'sort=contribucion_estado_id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>