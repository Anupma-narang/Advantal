<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_updated_at">
    <?php if ('updated_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=updated_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=updated_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nombre" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('nombre' == $sort[0]): ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=nombre&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Título', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=nombre&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tipo">
    <?php if ('tipo' == $sort[0]): ?>
        <?php echo link_to(__('Tipo', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=tipo&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Tipo', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=tipo&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('sector' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=sector&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=sector&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_subsector" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('subsector' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=subsector&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=subsector&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_actividad" style="width: 350px">
    <span class="block" style="width: 350px">
        <?php if ('actividad' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=actividad&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@cuestionario', array('query_string' => 'sort=actividad&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>