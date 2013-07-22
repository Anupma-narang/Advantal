<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <span class="block ">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@pizarra', array('query_string' => 'sort=created_at&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@pizarra', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
 </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
  <span class="block description">
  <?php if ('name' == $sort[0]): ?>
    <?php echo link_to(__('Titular', array(), 'messages'), '@pizarra', array('query_string' => 'sort=name&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Titular', array(), 'messages'), '@pizarra', array('query_string' => 'sort=name&sort_type=asc')) ?>
  <?php endif; ?>
    
   </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_seccion">
  <span class="block ">
  <?php if ('seccion' == $sort[0]): ?>
    <?php echo link_to(__('Sección', array(), 'messages'), '@pizarra', array('query_string' => 'sort=seccion&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Sección', array(), 'messages'), '@pizarra', array('query_string' => 'sort=seccion&sort_type=asc')) ?>
  <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_visibilidad">
  <span class="block ">
  <?php if ('visibilidad' == $sort[0]): ?>
    <?php echo link_to(__('Visibilidad', array(), 'messages'), '@pizarra', array('query_string' => 'sort=visibilidad&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Visibilidad', array(), 'messages'), '@pizarra', array('query_string' => 'sort=visibilidad&sort_type=asc')) ?>
  <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_schedule">
  <span class="block description">
  <?php echo __('Programación', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>