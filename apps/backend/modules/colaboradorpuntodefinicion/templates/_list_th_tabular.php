<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_codigo">
  <?php if ('codigo' == $sort[0]): ?>
    <?php echo link_to(__('Código', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=codigo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Código', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=codigo&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_descripcion">
    <span class="hdr-420 block">
      <?php if ('descripcion' == $sort[0]): ?>
        <?php echo link_to(__('Descripción', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=descripcion&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
      <?php else: ?>
        <?php echo link_to(__('Descripción', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=descripcion&sort_type=asc')) ?>
      <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_is_automatic">
  <?php if ('is_automatic' == $sort[0]): ?>
    <?php echo link_to(__('¿Automático?', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=is_automatic&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('¿Automático?', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=is_automatic&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_puntos">
  <?php if ('puntos' == $sort[0]): ?>
    <?php echo link_to(__('Nº puntos', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=puntos&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nº puntos', array(), 'messages'), '@colaboradorpuntodefinicion', array('query_string' => 'sort=puntos&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>