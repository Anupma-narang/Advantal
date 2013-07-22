<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_orden">
  <?php if ('orden' == $sort[0]): ?>
    <?php echo link_to(__('Orden', array(), 'messages'), '@gift', array('query_string' => 'sort=orden&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Orden', array(), 'messages'), '@gift', array('query_string' => 'sort=orden&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@gift', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@gift', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
  <span class="tamano_70_c block">
    <?php if ('name' == $sort[0]): ?>
      <?php echo link_to(__('Regalo', array(), 'messages'), '@gift', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Regalo', array(), 'messages'), '@gift', array('query_string' => 'sort=name&sort_type=asc')) ?>
    <?php endif; ?>
  </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_require_points">
  <?php if ('require_points' == $sort[0]): ?>
    <?php echo link_to(__('Puntos necesarios', array(), 'messages'), '@gift', array('query_string' => 'sort=require_points&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Puntos necesarios', array(), 'messages'), '@gift', array('query_string' => 'sort=require_points&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_hierarchy">
  <?php if ('hierarchy' == $sort[0]): ?>
    <?php echo link_to(__('Jerarquía', array(), 'messages'), '@gift', array('query_string' => 'sort=hierarchy&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Jerarquía', array(), 'messages'), '@gift', array('query_string' => 'sort=hierarchy&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_featured">
  <?php if ('featured' == $sort[0]): ?>
    <?php echo link_to(__('Home', array(), 'messages'), '@gift', array('query_string' => 'sort=featured&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Home', array(), 'messages'), '@gift', array('query_string' => 'sort=featured&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured_order">
  <?php if ('featured_order' == $sort[0]): ?>
    <?php echo link_to(__('Orden Home', array(), 'messages'), '@gift', array('query_string' => 'sort=featured_order&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Orden Home', array(), 'messages'), '@gift', array('query_string' => 'sort=featured_order&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>


<?php include_slot('sf_admin.current_header') ?>