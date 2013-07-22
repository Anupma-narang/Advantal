<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_id">
    <?php if ('id' == $sort[0]): ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Fecha de alta', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Fecha de alta', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username">
    <?php if ('username' == $sort[0]): ?>
        <?php echo link_to(__('Usuario/Alias', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=username&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Usuario/Alias', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=username&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_is_active">
    <?php if ('is_active' == $sort[0]): ?>
        <?php echo link_to(__('¿Activo?', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=is_active&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('¿Activo?', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=is_active&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_is_disabled">
    <?php if ('is_disabled' == $sort[0]): ?>
        <?php echo link_to(__('¿Deshabilitado?', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=is_disabled&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('¿Deshabilitado?', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=is_disabled&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_hierarchy" style="width:140px;">
    <span class="block" style="width:140px;">
        <?php if ('hierarchy' == $sort[0]): ?>
            <?php echo link_to(__('Jerarquía', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=hierarchy&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Jerarquía', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=hierarchy&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_email_address">
    <?php if ('email_address' == $sort[0]): ?>
        <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=email_address&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=email_address&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_last_login">
    <?php if ('last_login' == $sort[0]): ?>
        <?php echo link_to(__('Último acceso', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=last_login&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Último acceso', array(), 'messages'), '@sfguarduser', array('query_string' => 'sort=last_login&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>