<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <span class="created_at block">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creada el', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=created_at&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creada el', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_type">
  <span class="created_at block">
  <?php if ('type' == $sort[0]): ?>
    <?php echo link_to(__('Tipo de alerta', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=type&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Tipo de alerta', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=type&sort_type=asc')) ?>
  <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_message_without_html">
  <span class="description block">
  <?php echo __('Descripción', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_user_related_id">
  <?php if ('user_related_id' == $sort[0]): ?>
    <?php echo link_to(__('Usuario ', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=user_related_id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Usuario', array(), 'messages'), '@colaboradores_alertas', array('query_string' => 'sort=user_related_id&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>