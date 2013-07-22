<?php

$section_module_array = array('concurso_index' => 'Concursos Empresa/Entidad',
    'concurso_index' => 'Concursos Producto',
    'directorio_index' => 'Directorio',
    'listaBlanca_index' => 'Lista blanca empresas',
    'listaBlancaProducto_index' => 'Lista blanca producto',
    'listaNegra_indexEmpresas' => 'Lista negra empresas',
    'listaNegra_indexProductos' => 'Lista negra productos',
    'vosotros_hierarchyRanking' => 'Ranking colaboradores',
    'vosotros_rewardRanking' => 'Ranking recompensas')
?>
<?php if ($pizarra_section->getName() == 'Concursos de empresa/entidad'): ?>
  <?php echo 'Concursos Empresa/Entidad'; ?>
<?php else: ?>

  <?php $name = $pizarra_section->getModule() . '_' . $pizarra_section->getAction(); ?>
  <?php echo isset($section_module_array[$name]) ? $section_module_array[$name] : $pizarra_section->getModule() . ' , ' . $pizarra_section->getAction(); ?>
<?php endif; ?>