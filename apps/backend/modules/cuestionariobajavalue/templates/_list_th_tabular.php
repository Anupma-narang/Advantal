<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@cuestionario_baja_value', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@cuestionario_baja_value', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_apollo1" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php echo __('Apellido 1', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_apollo2" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php echo __('Apellido 2', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nombre" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php echo __('Nombre', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_user" style="width: 175px;">
    <span class="block" style="width: 175px;">
        <?php echo __('Usuario', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>