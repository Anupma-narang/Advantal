<div id="Dialog_content">
<div id="sf_admin_container">
<div id="sf_admin_content">
<h1>Nuevo comentario</h1>
<div class="sf_admin_list">
<form method="POST">
<table>
<tbody>
<?php echo $form?>
</tbody>
<tfoot><tr><td colspan="2">
	<!-- <input type="submit" value="aceptar"/> -->
	<?php echo jq_submit_to_remote('ajax_submit', 'guarda', array(
        'url'      	=> url_for('@newComentario?id='.$concurso_id),
        'update'   => array('success' => 'Dialog_content')
		)) ?>	
</td></tr></tfoot>
</table>
</form>
</div></div></div></div>