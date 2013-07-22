<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
    <span class="block" style="width: 350px">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_marca">
    <span class="block" style="width: 350px">
        <?php if ('marca' == $sort[0]): ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=marca&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=marca&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo">
    <span class="block" style="width: 70px">
        <?php if ('modelo' == $sort[0]): ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=modelo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector_name">
    <span class="block" style="width: 350px">
        <?php if ('sector_name' == $sort[0]): ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=sector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=sector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_subsector_name">
    <span class="block" style="width: 350px">
        <?php if ('subsector_name' == $sort[0]): ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=subsector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=subsector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tipo">
    <span class="block" style="width: 350px">
        <?php if ('tipo' == $sort[0]): ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=tipo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=tipo&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_medalla">
    <span class="block" style="width: 70px">
        <?php echo __('Medalla', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php /* include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
  <th class="sf_admin_text sf_admin_list_th_dividendo">
  <?php if ('dividendo' == $sort[0]): ?>
  <?php echo link_to(__('Puntos totales', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=dividendo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
  <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
  <?php echo link_to(__('Puntos totales', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=dividendo&sort_type=asc')) ?>
  <?php endif; ?>
  </th>
  <?php end_slot(); */ ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_auditorias">
    <span class="block" style="width: 77px">
        <?php echo __('Auditorías', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_isDestacado">
    <?php echo __('Destacado', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_featured">
    <?php if ('featured' == $sort[0]): ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=featured&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=featured&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured_order">
    <?php if ('featured_order' == $sort[0]): ?>
        <?php echo link_to(__('Orden Home', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=featured_order&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Orden Home', array(), 'messages'), '@producto_lista_blanca', array('query_string' => 'sort=featured_order&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>