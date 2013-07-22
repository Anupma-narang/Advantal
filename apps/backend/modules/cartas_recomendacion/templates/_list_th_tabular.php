<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Titulo', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Titulo', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_name_one" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('last_name_one' == $sort[0]): ?>
            <?php echo link_to(__('Apellido 1', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=last_name_one&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Apellido 1', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=last_name_one&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_name_two" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('last_name_two' == $sort[0]): ?>
            <?php echo link_to(__('Apellido 2', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=last_name_two&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Apellido 2', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=last_name_two&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_first_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('first_name' == $sort[0]): ?>
            <?php echo link_to(__('Nombre', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=first_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Nombre', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=first_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_state_name" style="width: 175px;">
    <span class="block" style="width: 175px;">
        <?php if ('state_name' == $sort[0]): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=state_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=state_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_city_name" style="width: 196px;">
    <span class="block" style="width: 196px;">
        <?php if ('city_name' == $sort[0]): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=city_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=city_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_SectorName" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('SectorName' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=SectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=SectorName&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_SubSectorName" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('SubSectorName' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=SubSectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=SubSectorName&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_activity_name_tres" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('activity_name_tres' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=activity_name_tres&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=activity_name_tres&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username" style="width: 175px;">
    <span class="block" style="width: 175px;">
        <?php if ('username' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=username&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=username&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_letter_estado">
    <?php if ('profesional_letter_estado' == $sort[0]): ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=profesional_letter_estado&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@profesional_letter_cartas_recomendacion', array('query_string' => 'sort=profesional_letter_estado&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>