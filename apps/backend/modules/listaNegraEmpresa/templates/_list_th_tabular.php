<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_created_at">
    <?php if ('created_at' == $sort[0]): ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=created_at&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Creada el', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_name">
    <span class="block" style="width: 350px">
        <?php if ('name' == $sort[0]): ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Empresa/Entidad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php /* include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
  <th class="sf_admin_text sf_admin_list_th_direccionConProvincia">
  <?php echo __('Direccion con provincia', array(), 'messages') ?>
  </th>
  <?php end_slot(); */ ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_states_name">
    <span class="block" style="width: 175px">
        <?php if ('states_name' == $sort[0]): ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=states_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Provincia', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=states_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_localidad_name">
    <span class="block" style="width: 210px">
        <?php if ('localidad_name' == $sort[0]): ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=localidad_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Localidad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=localidad_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_sector_name">
    <span class="block" style="width: 350px">
        <?php if ('sector_name' == $sort[0]): ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=sector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Sector', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=sector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_subsector_name">
    <span class="block" style="width: 350px">
        <?php if ('subsector_name' == $sort[0]): ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=subsector_name&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Subsector', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=subsector_name&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tressector">
    <span class="block" style="width: 350px">
        <?php if ('tressector' == $sort[0]): ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=tressector&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
            <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
        <?php else: ?>
            <?php echo link_to(__('Actividad', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=tressector&sort_type=asc')) ?>
        <?php endif; ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_comentariosRealizados" style="width: 77px">
    <span class="block" style="width: 77px">
        <?php echo __('Comentarios', array(), 'messages') ?>
    </span>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_featured">
    <?php if ('featured' == $sort[0]): ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=featured&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Home', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=featured&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_featured_order">
    <?php if ('featured_order' == $sort[0]): ?>
        <?php echo link_to(__('Orden Home', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=featured_order&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Orden Home', array(), 'messages'), '@lista_negra_empresa', array('query_string' => 'sort=featured_order&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>