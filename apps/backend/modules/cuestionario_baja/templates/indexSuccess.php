<div id="sf_admin_container">
<h1>Listado de bajas de colaboradores</h1>

<div id="sf_admin_content">
	<div class="sf_admin_list">
	<table>
	<thead><tr><th width="50%">Nombre</th><th>Acciones</th></tr></thead>
	<tbody>
		<?php foreach ($usuarios_cuestionario as $u):?><tr>
		<tr><td><?php echo $u->getUser()?></td><td><?php echo button_to('Ver', 'cuestionario_baja/show?id='.$u->getUserId())?></td></tr>
		<?php endforeach;?>
	</tbody>
	</table>
	</div>
</div>
</div>