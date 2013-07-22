<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_surname1">
  <span class="tamano_50_c block">
    <?php if ('surname1' == $sort[0]): ?>
      <?php echo link_to(__('Apellido 1', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=surname1&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Apellido 1', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=surname1&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_surname2">
  <span class="tamano_50_c block">
    <?php if ('surname2' == $sort[0]): ?>
      <?php echo link_to(__('Apellido 2', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=surname2&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Apellido 2', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=surname2&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
  <span class="tamano_50_c block">
    <?php if ('name' == $sort[0]): ?>
      <?php echo link_to(__('Nombre', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Nombre', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=name&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_email_address">
  <?php if ('email_address' == $sort[0]): ?>
    <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=email_address&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=email_address&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profile">
  <?php if ('permission' == $sort[0]): ?>
    <?php echo link_to(__('Perfil', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=permission&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Perfil', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=permission&sort_type=asc')) ?>
  <?php endif; ?>

</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_username">
  <span class="tamano_25_c block">
    <?php if ('username' == $sort[0]): ?>
      <?php echo link_to(__('Usuario', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=username&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Usuario', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=username&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>