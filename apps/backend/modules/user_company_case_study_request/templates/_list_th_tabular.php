<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creado el', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
    <span class="block" style="width:350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_empresa_sector_uno_id">
    <span class="block" style="width:350px;">
        <?php if ('empresa_sector_uno_id' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_uno_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_uno_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_empresa_sector_dos_id">
    <span class="block" style="width:350px;">
        <?php if ('empresa_sector_dos_id' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_dos_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_dos_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_empresa_sector_tres_id">
    <span class="block" style="width:350px;">
        <?php if ('empresa_sector_tres_id' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_tres_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=empresa_sector_tres_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_States">
    <span class="block" style="width:175px;">
        <?php if ('States' == $sort[0]): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=States&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=States&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_city_id">
    <span class="block" style="width:196px;">
        <?php if ('city_id' == $sort[0]): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=city_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=city_id&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_user_name">
    <span class="block" style="width:175px;">
        <?php if ('user_name' == $sort[0]): ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=user_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Usuario', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=user_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_status">
    <?php if ('status' == $sort[0]): ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=status&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Estado', array(), 'messages'), '@user_company_case_study_request', array('query_string' => 'sort=status&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>