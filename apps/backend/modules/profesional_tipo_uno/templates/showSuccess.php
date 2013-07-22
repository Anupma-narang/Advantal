<div id="sf_admin_container">
<h1>Detalle del sector profesional</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Orden</th><th>Sector</th><th>Imagen</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $profesional->getOrden()?></td>
	<td><?php echo $profesional->getName()?></td>
	<td><?php echo $profesional->getImage()!='' ? image_tag('/images/uploads/thumbnails/'.$profesional->getImage()) : ''?></td>
</tr>
</tbody>
</table>  
</div>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_list">
		<?php echo link_to('Volver al Listado','profesional_tipo_uno/index')?>
	</li>
</ul>

</div>
