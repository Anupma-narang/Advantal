<?php if ($sf_params->get('action')=='index'): ?>
  <ul id="submenu_concursos">
    <li><a href="<?php echo url_for('@concurso_categoria') ?>">Todas</a></li>
    <li><a href="<?php echo url_for('@concurso_categoria_empresa') ?>">Empresa/Entidad</a></li>
    <li><a href="<?php echo url_for('@concurso_categoria_producto') ?>">Producto</a></li>
  </ul>
<?php endif ?>