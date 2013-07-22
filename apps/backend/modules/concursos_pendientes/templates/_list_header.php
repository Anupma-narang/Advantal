<ul id="submenu_concursos">
  <li>
     <?php echo link_to( __('Todos'), url_for('concursos_pendientes'),array('title' => __('Casos de empresa/entidad'))); ?>
  </li>   
  <li>
     <?php echo link_to( __('Empresa/Entidad'), url_for('concurso_concursos_pendientes_empresa'),array('title' => __('Casos de empresa/entidad'))); ?>
  </li>
  <li>
    <?php echo link_to( __('Producto'), url_for('concurso_concursos_pendientes_product'),array('title' => __('Casos de product'))); ?>
  </li>
</ul>
<?php if ($sf_params->get('action')=='index'): ?>
    <a id="hide_show_filters" class="hide_show_filters_label" href="#" style=" bottom: 0;display: block;float: left;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a><br />
<?php endif ?>