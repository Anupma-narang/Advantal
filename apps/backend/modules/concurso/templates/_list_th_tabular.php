<?php
$filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');
?>
<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@concurso', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@concurso', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_resumename" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@concurso', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@concurso', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>

<th class="sf_admin_boolean sf_admin_list_th_destacado">
    <?php if ('destacado' == $sort[0]): ?>
        <?php echo link_to(__('Destacado', array(), 'messages'), '@concurso', array('query_string' => 'sort=destacado&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Destacado', array(), 'messages'), '@concurso', array('query_string' => 'sort=destacado&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php /* include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
  <th class="sf_admin_text sf_admin_list_th_concurso_tipo">
  <?php if ('concurso_tipo_id' == $sort[0]): ?>
  <?php echo link_to(__('Tipo de concurso', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_tipo_id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
  <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
  <?php echo link_to(__('Tipo de concurso', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_tipo_id&sort_type=asc')) ?>
  <?php endif; ?>
  </th>
  <?php end_slot(); */ ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_tipo">
    <?php echo __('Tipo de concurso', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_categoria" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('concurso_categoria_id' == $sort[0]): ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_categoria_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Categoría', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_categoria_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php if ($filtering_estados_tipos == "empresa_entidad"): ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_empresa" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('empresa_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "empresa") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "empresa")): ?>           
                <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=empresa')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=asc&columnname=empresa')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_sector" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('empresa_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "sector") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "sector")): ?>           
                <?php echo link_to(__('Sector', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=sector')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Sector', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=asc&columnname=sector')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_subsector" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('empresa_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "subsector") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "subsector")): ?>
                <?php echo link_to(__('Subsector', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=subsector')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Subsector', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=asc&columnname=subsector')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_actividad" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('empresa_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "tresector") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "tresector")): ?>
                <?php echo link_to(__('Actividad', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=tresector')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Actividad', array(), 'messages'), '@concurso', array('query_string' => 'sort=empresa_id&sort_type=asc&columnname=tresector')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_provincia" style="width: 176px;">
        <span class="block" style="width: 176px;">
            <?php if ('states_id' == $sort[0]): ?>
                <?php echo link_to(__('Provincia', array(), 'messages'), '@concurso', array('query_string' => 'sort=states_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Provincia', array(), 'messages'), '@concurso', array('query_string' => 'sort=states_id&sort_type=asc')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_localidad" style="width: 210px;">
        <span class="block" style="width: 210px;">
            <?php if ('city_id' == $sort[0]): ?>
                <?php echo link_to(__('Localidad', array(), 'messages'), '@concurso', array('query_string' => 'sort=city_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Localidad', array(), 'messages'), '@concurso', array('query_string' => 'sort=city_id&sort_type=asc')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
<?php endif ?>
<?php if ($filtering_estados_tipos == "producto"): ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_producto" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columname") == "producto") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "producto")): ?>
                <?php echo link_to(__('Producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=producto')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=producto')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_marca" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columname") == "marca") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "marca")): ?>
                <?php echo link_to(__('Marca', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=marca')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Marca', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=marca')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_modelo" style="width: 141px;">
        <span class="block" style="width: 141px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "modelo") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "modelo")): ?>
                <?php echo link_to(__('Modelo', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=modelo')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Modelo', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=modelo')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_sector_del_producto" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "productuno") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "productuno")): ?>
                <?php echo link_to(__('Sector del producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=productuno')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Sector del producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=productuno')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_subsector_del_producto" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "productdos") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "productdos")): ?>
                <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=productdos')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=productdos')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
    <th class="sf_admin_text sf_admin_list_th_tipo_de_producto" style="width: 350px;">
        <span class="block" style="width: 350px;">
            <?php if (('producto_id' == $sort[0] && $sf_request->hasParameter("columnname") && $sf_request->getParameter("columnname") == "producttres") || (isset($sort[2]) && !empty($sort[2]) && $sort[2] == "producttres")): ?>
                <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc') . '&columnname=producttres')) ?>
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
            <?php else: ?>
                <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@concurso', array('query_string' => 'sort=producto_id&sort_type=asc&columnname=producttres')) ?>
            <?php endif; ?>
        </span>
    </th>
    <?php end_slot(); ?>
<?php endif ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 176px;">
    <span class="block" style="width: 176px;">
        <?php if ('user_id' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@concurso', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@concurso', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_concurso_estado">
    <?php if ('concurso_estado_id' == $sort[0]): ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_estado_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@concurso', array('query_string' => 'sort=concurso_estado_id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured">
    <?php if ('featured' == $sort[0]): ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@concurso', array('query_string' => 'sort=featured&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@concurso', array('query_string' => 'sort=featured&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured_order">
    <?php if ('featured_order' == $sort[0]): ?>
        <?php echo link_to(__('Orden home', array(), 'messages'), '@concurso', array('query_string' => 'sort=featured_order&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Orden home', array(), 'messages'), '@concurso', array('query_string' => 'sort=featured_order&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>