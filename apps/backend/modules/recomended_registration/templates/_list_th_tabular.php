<style type="text/css">
    tr.sf_admin_row td:last-child {
    padding-left:8px !important;
}
</style>
<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_registered_user">
  <span class="tamano_25_c block">
    <?php if ('registered_user' == $sort[0]): ?>
      <?php echo link_to(__('Nuevo colaborador', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=registered_user&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Nuevo colaborador', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=registered_user&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_recomended_user">
  <span class="tamano_25_c block">
    <?php if ('recomended_user' == $sort[0]): ?>
      <?php echo link_to(__('Recomendado por', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=recomended_user&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Recomendado por', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=recomended_user&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_email">
  <?php if ('email' == $sort[0]): ?>
    <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=email&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Correo electrónico', array(), 'messages'), '@recomended_registration', array('query_string' => 'sort=email&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>