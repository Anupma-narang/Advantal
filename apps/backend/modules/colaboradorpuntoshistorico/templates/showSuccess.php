
<div id="sf_admin_container">
<h1>Punto definición</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Usuario</th><th>Descripción</th><th>Puntos</th><th>Creado el</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $historico->getsfGuardUser()->getUsername()?></td>
	<td><?php echo $historico->getDescripcion()?>
	<td><?php echo $historico->getPuntos()?></td>
	<td><?php echo $historico->getDateTimeObject('created_at')->format('d-m-Y H:i')?></td>
</tr>
</tbody>
</table>  
</div>
<?php echo link_to('Volver al Listado','colaboradorpuntoshistorico/index')?>
</div>