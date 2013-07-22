<ul id="submenu_concursos">
  <li>
     <?php echo link_to( __('Empresa/Entidad'), url_for('user_company_case_study'),array('title' => __('Casos de empresa/entidad'))); ?>
  </li>
  <li>
    <?php echo link_to( __('Producto'), url_for('user_product_case_study'),array('title' => __('Casos de product'))); ?>
  </li>
</ul>
<?php echo image_tag('check_red.gif') ?> <?php echo __('Revista') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_blue.gif') ?> <?php echo __('Tramitado ') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_green.gif') ?> <?php echo __('Cerrado') ?>
<br><br>
<div style="width:100%; padding-bottom: 8px;">
    <a id="hide_show_filters" href="javascript:void(0);" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a>
</div>