<div id="sf_admin_container">
<h1>Detalle de la categoría de concurso</h1>


<div id="sf_admin_content">
<table>
	<thead><tr><th>Categoría</th><th>Tipo de concurso</th><th>Imagen</th></tr></thead>
<tbody>
<tr>
	<td><?php echo $categoria->getName()?></td>
	<td><?php echo $categoria->getConcursoTipo()?></td>
	<td><?php echo $categoria->getImage()!='' ? image_tag('/images/uploads/thumbnails/'.$categoria->getImage()) : ''?></td>
</tr>
</tbody>
</table>  
</div>
<div class="volver_al_listado123">
    <?php echo link_to('Volver al Listado','concurso_categoria/index')?>
</div>
</div>