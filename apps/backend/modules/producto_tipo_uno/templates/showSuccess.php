<div id="sf_admin_container">
<h1>Detalle del sector de Producto</h1>

<div id="sf_admin_content">
<table>
	<!--<thead><tr><th>Orden</th><th>Sector de producto</th><th>Imagen</th><th>Slug</th></tr></thead>-->
	<thead><tr><th>Sector de producto</th><th>Imagen</th></tr></thead>
<tbody>
<tr>
	<!--<td><?php //echo $producto->getOrden()?></td>-->
	<td><?php echo $producto->getName()?></td>
	<td><?php echo $producto->getImage()!='' ? image_tag('/images/uploads/thumbnails/'.$producto->getImage()) : ''?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123">
<?php echo link_to('Volver al Listado','producto_tipo_uno/index')?>
</div>
</div>