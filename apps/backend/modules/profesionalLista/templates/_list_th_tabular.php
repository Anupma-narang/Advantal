<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_name_one" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('last_name_one' == $sort[0]): ?>
            <?php echo link_to(__('Apellido 1', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=last_name_one&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Apellido 1', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=last_name_one&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_name_two" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('last_name_two' == $sort[0]): ?>
            <?php echo link_to(__('Apellido 2', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=last_name_two&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Apellido 2', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=last_name_two&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_first_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('first_name' == $sort[0]): ?>
            <?php echo link_to(__('Nombre', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=first_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Nombre', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=first_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_States" style="width: 175px;">
    <span class="block" style="width: 175px;">
        <?php if ('States' == $sort[0]): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=States&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=States&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_City" style="width: 196px;">
    <span class="block" style="width: 196px;">
        <?php if ('City' == $sort[0]): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=City&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=City&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_tipo_uno" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('profesional_tipo_uno' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=profesional_tipo_uno&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=profesional_tipo_uno&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_tipo_dos" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('profesional_tipo_dos' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=profesional_tipo_dos&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=profesional_tipo_dos&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tipo" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('tipo_tres' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=tipo_tres&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=tipo_tres&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 175px;">
    <span class="block" style="width: 175px;">
        <?php if ('username' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=username&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@profesional_lista', array('query_string' => 'sort=username&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_estado">
    <?php echo __('Estado', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_isDestacada">
    <?php echo __('Destacado', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured">
    <?php echo __('Home', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured_order">
    <?php echo __('Orden home', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>