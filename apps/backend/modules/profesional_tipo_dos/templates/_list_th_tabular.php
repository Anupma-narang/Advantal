<?php slot('sf_admin.current_header'); ?>
<script type="text/javascript">
$('#sf_admin_list_batch_actions').attr('style','width:15px;');
</script>
<th class="sf_admin_text sf_admin_list_th_id">
    <?php if ('id' == $sort[0]): ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_orden">
    <?php if ('orden' == $sort[0]): ?>
        <?php echo link_to(__('Orden', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=orden&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Orden', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=orden&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name" style="width:350px">
    <span class="block" style="width:350px">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_profesional_tipo_uno" style="width:350px">
    <span class="block" style="width:350px">
        <?php if ('profesional_tipo_uno' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=profesional_tipo_uno&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@profesional_tipo_dos', array('query_string' => 'sort=profesional_tipo_uno&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>