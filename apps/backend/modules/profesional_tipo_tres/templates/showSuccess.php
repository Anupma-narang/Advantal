<div id="sf_admin_container">
<h1>Detalle de la actividad profesional</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Orden</th><th>Actividad</th><th>Sector</th><th>Subsector</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $profesional->getOrden()?></td>
	<td><?php echo $profesional->getName()?></td>
	<td><?php echo $profesional->getProfesionalTipoUno()?></td>
	<td><?php echo $profesional->getProfesionalTipoDos()?></td>
</tr>
</tbody>
</table>  
</div>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_list">
		<?php echo link_to('Volver al Listado','profesional_tipo_tres/index')?>
	</li>
</ul>
</div>
