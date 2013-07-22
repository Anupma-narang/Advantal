<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <span class="hdr-120 block">
        <?php if ('created_at' == $sort[0]): ?>
            <?php echo link_to(__('Creado el', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Creado el', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resumename" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>    
</span>
</th>
<?php end_slot(); ?>
<!--<?php //include_slot('sf_admin.current_header')  ?><?php //slot('sf_admin.current_header')  ?>
<th class="sf_admin_text sf_admin_list_th_concurso_tipo">
<?php //if ('concurso_tipo_id' == $sort[0]): ?>
<?php //echo link_to(__('Tipo de concurso', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=concurso_tipo_id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
<?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
<?php //else: ?>
<?php //echo link_to(__('Tipo de concurso', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=concurso_tipo_id&sort_type=asc')) ?>
<?php //endif; ?>
</th>
<?php //end_slot(); ?>-->
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_producto" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('producto_id' == $sort[0] && !$sf_request->hasParameter("columnname")): ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_marca" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "marca"): ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=marca')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=marca')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo" style="width: 176px;"> 
    <span class="block" style="width: 176px;">
        <?php if ('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "modelo"): ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=modelo')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=modelo')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "sector"): ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=sector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=sector')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_subsector" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "subsector"): ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=subsector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=subsector')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_actividad" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "tresector"): ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=tresector')) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=tresector')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_categoria" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('concurso_categoria_id' == $sort[0]): ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=concurso_categoria_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=concurso_categoria_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>    
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username">
    <span class="block" style="width: 176px;">
        <?php if ('user_id' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@concurso_concursos_pendientes_product', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_estado">
    <?php echo __('Estado', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>