<ul id="submenu_concursos">
  <li>
     <?php echo link_to( __('Todos'), url_for('contribucion_planes_de_accion')); ?>
  </li>   
  <li>
     <?php echo link_to( __('Empresa/Entidad'), url_for('contribucion_planes_de_accion_empresa')); ?>
  </li>
  <li>
    <?php echo link_to( __('Producto'), url_for('contribucion_planes_de_accion_producto')); ?>
  </li>
</ul>
<!--<ul id="submenu_concursos">
  <li><a href="<?php echo url_for('@contribucion_planes_de_accion_empresa') ?>">Empresa/Entidad</a></li>
  <li>Producto</li>
</ul>-->
<?php if ($sf_params->get('action')=='index'): ?>
    <a id="hide_show_filters" class="hide_show_filters_label" href="#" style=" bottom: 0;display: block;float: left;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a><br />
<?php endif ?>