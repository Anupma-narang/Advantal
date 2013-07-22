<div id="sf_admin_container">
<h1>Detalle del subsector de Producto</h1>


<div id="sf_admin_content">
<table>
	<!--<thead><tr><th>Orden</th><th>Subsector de producto</th><th>Sector</th><th>Imagen</th><th>Slug</th></tr></thead>-->
	<thead><tr><th>Subsector de producto</th><th>Sector</th></tr></thead>
<tbody>
<tr>
	<!--<td><?php //echo $producto->getOrden()?></td>-->
	<td><?php echo $producto->getName()?></td>
	<td><?php echo $producto->getProductoTipoUno()?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123">
<?php echo link_to('Volver al Listado','producto_tipo_dos/index')?>
</div>
</div>