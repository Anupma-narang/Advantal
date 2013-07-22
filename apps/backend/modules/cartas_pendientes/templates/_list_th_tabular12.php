<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
  <?php if ('created_at' == $sort[0]): ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@profesional_letter', array('query_string' => 'sort=created_at&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Creado el', array(), 'messages'), '@profesional_letter', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>


<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_td_name">
  <?php echo __('Título', array(), 'messages') ?>
</th>
<?php end_slot(); ?>


<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_letter_type">
  <?php echo __('Tipo de carta', array(), 'messages') ?>
</th>
<?php end_slot(); ?>


<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_td_username">
  <?php echo __('Usuario', array(), 'messages') ?>
</th>
<?php end_slot(); ?>


<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_letter_estado">
  <?php echo __('Estado', array(), 'messages') ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?>