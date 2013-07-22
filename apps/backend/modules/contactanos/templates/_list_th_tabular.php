<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@contactanos', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@contactanos', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nombre">
  <span class="tamano_50_c block">
    <?php if ('nombre' == $sort[0]): ?>
      <?php echo link_to(__('Nombre', array(), 'messages'), '@contactanos', array('query_string' => 'sort=nombre&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Nombre', array(), 'messages'), '@contactanos', array('query_string' => 'sort=nombre&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_apellido1">
  <span class="tamano_50_c block">
    <?php if ('apellido1' == $sort[0]): ?>
      <?php echo link_to(__('Apellido 1', array(), 'messages'), '@contactanos', array('query_string' => 'sort=apellido1&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Apellido 1', array(), 'messages'), '@contactanos', array('query_string' => 'sort=apellido1&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_apellido2">
  <span class="tamano_50_c block">
    <?php if ('apellido2' == $sort[0]): ?>
      <?php echo link_to(__('Apellido 2', array(), 'messages'), '@contactanos', array('query_string' => 'sort=apellido2&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Apellido 2', array(), 'messages'), '@contactanos', array('query_string' => 'sort=apellido2&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_email">
  <span class="tamano_70_c block">
    <?php if ('email' == $sort[0]): ?>
      <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@contactanos', array('query_string' => 'sort=email&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@contactanos', array('query_string' => 'sort=email&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_user_id">
  <span class="tamano_25_c block">
    <?php if ('user_id' == $sort[0]): ?>
      <?php echo link_to(__('Usuario', array(), 'messages'), '@contactanos', array('query_string' => 'sort=user_id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Usuario', array(), 'messages'), '@contactanos', array('query_string' => 'sort=user_id&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_status">
  <?php if ('status' == $sort[0]): ?>
    <?php echo link_to(__('Estado', array(), 'messages'), '@contactanos', array('query_string' => 'sort=status&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Estado', array(), 'messages'), '@contactanos', array('query_string' => 'sort=status&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>