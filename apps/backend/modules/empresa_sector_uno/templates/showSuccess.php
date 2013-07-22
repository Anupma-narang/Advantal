<div id="sf_admin_container">
<h1>Detalle del sector de Empresa/Entidad</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Orden</th><th>Sector</th><th>Imagen</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $empresa->getOrden()?></td>
	<td><?php echo $empresa->getName()?></td>
	<td><?php echo $empresa->getImage()!='' ? image_tag('/images/uploads/thumbnails/'.$empresa->getImage()) : ''?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123"> 
<?php echo link_to('Volver al Listado','empresa_sector_uno/index')?>
</div>
</div>