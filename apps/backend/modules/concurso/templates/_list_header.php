<?php if(isset($type)):?>
<h3><?php echo $type?></h3>
<?php endif;?>

<?php if ($sf_params->get('action')=='index'): ?>
  <?php $filtering_estados_tipos=$sf_user->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module'); ?>
  
  <ul id="submenu_concursos">
  <li><?php if ($filtering_estados_tipos==''): ?>Todos<?php else: ?><a href="concurso/filtering?val=">Todos</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='empresa_entidad'): ?>Empresa/Entidad<?php else: ?><a href="concurso/filtering?val=empresa_entidad">Empresa/Entidad</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='producto'): ?>Producto<?php else: ?><a href="concurso/filtering?val=producto">Producto</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='activo'): ?>Activos<?php else: ?><a href="concurso/filtering?val=activo">Activos</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='referendum'): ?>Referéndum<?php else: ?><a href="concurso/filtering?val=referendum">Referéndum</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='deliberacion'): ?>Deliberación<?php else: ?><a href="concurso/filtering?val=deliberacion">Deliberación</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='observacion'): ?>Observación<?php else: ?><a href="concurso/filtering?val=observacion">Observación</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='rechazados'): ?>Rechazados<?php else: ?><a href="concurso/filtering?val=rechazados">Rechazados</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='cerrados'): ?>Cerrados<?php else: ?><a href="concurso/filtering?val=cerrados">Cerrados</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='nulos'): ?>Nulos<?php else: ?><a href="concurso/filtering?val=nulos">Nulos</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='revision'): ?>Revisión<?php else: ?><a href="concurso/filtering?val=revision">Revisión</a><?php endif ?></li>
  <li><?php if ($filtering_estados_tipos=='borrador'): ?>Borrador<?php else: ?><a href="concurso/filtering?val=borrador">Borrador</a><?php endif ?></li>
  </ul>
  
  &nbsp;&nbsp;&nbsp;&nbsp;
  <div>
      <div id="abc"><?php if ($filtering_estados_tipos=='' || $filtering_estados_tipos=='empresa_entidad' || $filtering_estados_tipos=='producto' || $filtering_estados_tipos=='referendum'): ?>
        <?php echo image_tag('check_green.gif') ?> <?php echo __('Destacado de la semana') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_blue.gif') ?> <?php echo __('Destacado del mes') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_red.gif') ?> <?php echo __('Destacado del año') ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!--<a id="hide_show_filters" href="#"><strong>Esconder/Mostrar filtros</strong></a>-->
        <br /><br />
      <?php endif ?>
        </div>
      <div style="width:100%; padding-bottom: 8px;">
        <a id="hide_show_filters" href="javascript:void(0);" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a>
      </div>
  </div>
<?php endif ?>
