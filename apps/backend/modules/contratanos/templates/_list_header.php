<ul id="submenu_concursos">
  <li><?php echo link_to(__('Empresa/Entidad'), url_for('contratanos'), array())?></li>
  <li><?php echo link_to(__('Profesional'), url_for('contratanos_contratanos_professional'), array())?></li>
</ul>
<?php echo image_tag('check_red.gif') ?> <?php echo __('Revista') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_blue.gif') ?> <?php echo __('Tramitado ') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_green.gif') ?> <?php echo __('Cerrado') ?>
<br><br>
<div>
    <div style="width:100%; padding-bottom: 8px;">
        <a id="hide_show_filters" href="#" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0; outline:none;"><strong>Esconder/Mostrar filtros</strong></a>
    </div>
</div>