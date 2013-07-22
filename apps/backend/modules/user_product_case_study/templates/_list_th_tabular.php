<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Producto', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_marca">
    <span class="block" style="width: 350px;">
        <?php if ('marca' == $sort[0]): ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=marca&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Marca', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=marca&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo">
    <span class="block" style="width: 140px;">
        <?php if ('modelo' == $sort[0]): ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=modelo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Modelo', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector">
    <span class="block" style="width: 350px;">
        <?php if ('sectorName' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=sectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=sectorName&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sub_sector">
    <span class="block" style="width: 350px;">
        <?php if ('subSectorName' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=subSectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=subSectorName&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tipo">
    <span class="block" style="width: 350px;">
        <?php if ('sector' == $sort[0]): ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=sector&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de producto', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=sector&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_user_name">
    <span class="block" style="width: 165px;">
        <?php if ('user_name' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=user_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=user_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_status">
    <?php if ('status' == $sort[0]): ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=status&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@user_product_case_study', array('query_string' => 'sort=status&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>