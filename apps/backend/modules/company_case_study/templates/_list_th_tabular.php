<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
  <span class="block" style="width: 350px">
    <?php if ('name' == $sort[0]): ?>
      <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=name&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_states_id">
  <span class="block" style="width: 176px">
    <?php if ('Statesname' == $sort[0]): ?>
      <?php echo link_to(__('Provincia', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=Statesname&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Provincia', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=Statesname&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_city_id">
  <span class="block" style="width: 196px">
    <?php if ('CityName' == $sort[0]): ?>
      <?php echo link_to(__('Localidad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=CityName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Localidad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=CityName&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_SectorName">
  <span class="block" style="width: 350px">
    <?php if ('SectorName' == $sort[0]): ?>
      <?php echo link_to(__('Sector', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=SectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Sector', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=SectorName&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_SubSectorName">
  <span class="block" style="width: 350px">
    <?php if ('SubSectorName' == $sort[0]): ?>
      <?php echo link_to(__('Subsector', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=SubSectorName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Subsector', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=SubSectorName&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_ActividadName">
  <span class="block" style="width: 350px">
    <?php if ('ActividadName' == $sort[0]): ?>
      <?php echo link_to(__('Actividad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=ActividadName&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Actividad', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=ActividadName&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_status">
  <?php if ('status' == $sort[0]): ?>
    <?php echo link_to(__('Estado', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=status&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Estado', array(), 'messages'), '@company_case_study', array('query_string' => 'sort=status&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>