<div id="sf_admin_container">
<h1>Detalle del subsector profesional</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Orden</th><th>Subsector</th><th>Sector</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $profesional->getOrden()?></td>
	<td><?php echo $profesional->getName()?></td>
	<td><?php echo $profesional->getProfesionalTipoUno()?></td>
</tr>
</tbody>
</table>  
</div>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_list">
		<?php echo link_to('Volver al Listado','profesional_tipo_dos/index')?>
	</li>
</ul>
</div>
