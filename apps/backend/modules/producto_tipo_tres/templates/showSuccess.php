<div id="sf_admin_container">
<h1>Detalle del tipo de Producto</h1>


<div id="sf_admin_content">
<table>
	<!--<thead><tr><th>Orden</th><th>Tipo de producto</th><th>Sector</th><th>Subsector</th><th>Imagen</th><th>Slug</th></tr></thead>-->
	<thead><tr><th>Tipo de producto</th><th>Sector</th><th>Subsector</th></tr></thead>
<tbody>
<tr>
	<!--<td><?php //echo $producto->getOrden()?></td>-->
	<td><?php echo $producto->getName()?></td>
	<td><?php echo $producto->getProductoTipoUno()?></td>
	<td><?php echo $producto->getProductoTipoDos()?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123">
<?php echo link_to('Volver al Listado','producto_tipo_tres/index')?>
</div>
</div>