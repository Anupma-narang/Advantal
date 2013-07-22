<div id="sf_admin_container">
<h1>Detalle de la actividad de Empresa/Entidad</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Orden</th><th>Actividad</th><th>Sector</th><th>Subsector</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $empresa->getOrden()?></td>
	<td><?php echo $empresa->getName()?></td>
	<td><?php echo $empresa->getEmpresaSectorUno()?></td>
	<td><?php echo $empresa->getEmpresaSectorDos()?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123">
<?php echo link_to('Volver al Listado','empresa_sector_tres/index')?>
</div>
</div>