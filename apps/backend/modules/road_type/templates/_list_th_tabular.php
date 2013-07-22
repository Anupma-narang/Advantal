<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_id">
    <?php if ('id' == $sort[0]): ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@road_type', array('query_string' => 'sort=id&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Id', array(), 'messages'), '@road_type', array('query_string' => 'sort=id&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_orden" style="width: 55px;">
    <span class="block" style="width: 55px;">
        <?php if ('orden' == $sort[0]): ?>
            <?php echo link_to(__('Orden', array(), 'messages'), '@road_type', array('query_string' => 'sort=orden&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Orden', array(), 'messages'), '@road_type', array('query_string' => 'sort=orden&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name" style="width: 350px;">
    <span class="block" style="width: 350px;">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Tipo de vía', array(), 'messages'), '@road_type', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Tipo de vía', array(), 'messages'), '@road_type', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>