<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@producto', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@producto', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@producto', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@producto', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_marca" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('marca' == $sort[0]): ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@producto', array('query_string' => 'sort=marca&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@producto', array('query_string' => 'sort=marca&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo" style="width: 70px">
    <span class="block" style="width: 70px">
        <?php if ('modelo' == $sort[0]): ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector_name" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('sector_name' == $sort[0]): ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@producto', array('query_string' => 'sort=sector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector del producto', array(), 'messages'), '@producto', array('query_string' => 'sort=sector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_subsector_name" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('subsector_name' == $sort[0]): ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@producto', array('query_string' => 'sort=subsector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector del producto', array(), 'messages'), '@producto', array('query_string' => 'sort=subsector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tipo" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('tipo' == $sort[0]): ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@producto', array('query_string' => 'sort=tipo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@producto', array('query_string' => 'sort=tipo&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_lista">
    <span class="block" style="width: 47px">
        <?php echo __('Lista', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>
     