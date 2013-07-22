<h2>Acciones sobre el profesional</h2>
<ul>
<?php if ($profesional->profesional_estado_id==1):?>
	<li><?php echo link_to_function(image_tag("tick")."Activar", 'procesar_puntos()')?></li>
	<li><?php echo link_to(image_tag("email")."Sugerir modificaciones","profesionalLista/rechazar?id=".$profesional->id)?></li>
<?php elseif($profesional->profesional_estado_id==2):?>
		<li><?php echo link_to(image_tag("tick")."Poner en Referendum","profesionalLista/changeStatus?id=".$profesional->id."&estado=3")?></li>
<?php elseif($profesional->profesional_estado_id==3):?>
		<li><?php echo link_to(image_tag("tick")."Poner en Deliberación","profesionalLista/changeStatus?id=".$profesional->id."&estado=4")?></li>
<?php elseif($profesional->profesional_estado_id==4):?>
	<li><?php echo link_to(image_tag("tick")."Poner en Observación","profesionalLista/changeStatus?id=".$profesional->id."&estado=5")?></li>
	<li><?php echo link_to(image_tag("error")."Rechazar profesional","profesionalLista/changeStatus?id=".$profesional->id."&estado=7")?></li>
<?php elseif($profesional->profesional_estado_id==5):?>
<?php elseif($profesional->profesional_estado_id==6):?>
<?php elseif($profesional->profesional_estado_id==7):?>
<?php elseif($profesional->profesional_estado_id==8):?>
<?php elseif($profesional->profesional_estado_id==9):?>
<?php endif;?>
<?php if(($profesional->profesional_estado_id==5) || ($profesional->profesional_estado_id==4)):?>
	<li><?php echo link_to(image_tag("error")."Cerrar profesional","profesionalLista/changeStatus?id=".$profesional->id."&estado=6")?></li>
<?php endif;?>	
<?php if(($profesional->profesional_estado_id!=10) && ($profesional->profesional_estado_id!=8) && ($profesional->profesional_estado_id!=6) && ($profesional->profesional_estado_id!=7) && ($profesional->profesional_estado_id!=9)):?>
	<li><?php echo link_to(image_tag("error")."Poner en Revisión","profesionalLista/changeStatus?id=".$profesional->id."&estado=10")?></li>
<?php elseif($profesional->profesional_estado_id==10):?>
	<?php if($last_state = Doctrine::getTable('ProfesionalEstado')->findOneBy('id', $profesional->getRevisionLastStateId())):?>
		<li><?php echo link_to(image_tag("tick")."Reactivar","profesionalLista/changeStatus?id=".$profesional->id."&estado=".$last_state->getId())?></li>
	<?php endif;?>
<?php endif;?>

<?php if(in_array($profesional->profesional_estado_id, array(5,6,7,8)) || ($profesional->profesional_estado_id==3 )): // && $profesional->getNumeroVotantes()==0)):?>
	<li><?php echo link_to(image_tag("revert")."Deshacer estado","profesionalLista/revertStatus?id=".$profesional->id)?></li>
<?php else: ?>
	<li><?php echo link_to_function(image_tag("revert")."Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este profesional\')')?></li>
<?php endif ?>
</ul>

<?php if(in_array($profesional->profesional_estado_id,array(2,3))):?>
	<?php $tiempos=array(1=>" la semana", 2=>"l mes", 3=>"l año")?>
	<?php $tiempos_iconos=array(1=>"check_green.gif", 2=>"check_blue.gif", 3=>"check_red.gif")?>
	<ul>
	<?php if ($profesional->destacado):?>
			<li><?php echo image_tag('info-icon') ?><strong>¡Concurso destacado!</strong> <?php echo link_to("Quitar destacado","profesionales_pendientes/retirar?tipo=normal&profesional_id=".$profesional->id)?></li>
		<?php else:?>
			<?php if($n_profesional_destacados < 10):?>
				<li><?php echo link_to("Destacar profesional","profesionales_pendientes/destacar?tipo=normal&profesional_id=".$profesional->id)?></li>
			<?php else:?>
				<li><?php echo link_to_function("Destacar profesional","alert('No puedes destacar más de 10 concursos a la vez')")?></li>
			<?php endif;?>
	<?php endif; ?>	
	<?php foreach($tiempos as $i=>$tiempo):?>
		<?php if($profesional->isProfesionalDestacadoTiempo($i)):?>
			<li><?php echo image_tag($tiempos_iconos[$i]) ?><strong>¡Este es el profesional destacado de<?php echo $tiempo?>!</strong> <?php echo link_to("Quitar destacado","profesionales_pendientes/retirar?tipo=temporal&tiempo=".$i."&profesional_id=".$profesional->id)?></li>
		<?php else:?>			
			<?php if($n_profesional_destacados_tiempo[$i]==0):?>
					<li><?php echo link_to("Poner como profesional de$tiempo","profesionales_pendientes/destacar?tipo=temporal&tiempo=".$i."&profesional_id=".$profesional->id)?></li>
			<?php else:?>
					<li><?php echo link_to_function("Poner como profesional de$tiempo","alert('No puedes destacar más de 1 profesional de$tiempo a la vez')")?></li>
			<?php endif;?>
		<?php endif;?>
	<?php endforeach;?>
	</ul>
<?php endif;?>

<ul>
<li class="sf_admin_action_edit"><?php echo link_to("Editar profesional","profesionales_pendientes/edit?id=".$profesional->id)?></li>
<?php echo $helper->linkToDelete($profesional, array(  'params' =>   array(  ),  'confirm' => '¿Estás seguro?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<li> <?php echo link_to('volver a profesional','@profesional_lista')?></li>
</ul>


<script>
var procesar_puntos = function(){

	var valido = false;
	$('input:checkbox').each(function(){
		if($(this).attr("checked") == "checked" || $(this).attr("checked") == true){
			console.log('si');
			valido = true;
		}
		if (valido) {
			return false;
		}
	});
	
	if($('#Otro_puntos').val()!='')
		valido = true;
	
	if(($("#Otro_descripcion").val()) && ($("#Otro_puntos").val()==''))
		alert('Necesitas incluir una descripción y los puntos a asignar.');
	else if(($("#Otro_descripcion").val()=='') && ($("#Otro_puntos").val()))
		alert('Necesitas incluir una descripción y los puntos a asignar.');
	else if(($("#Otro_descripcion").val()) && ($("#Otro_puntos").val()) && (isNaN($("#Otro_puntos").val())))
		alert('Necesitas incluir una descripción y los puntos a asignar.');
	else {
		if(valido){
			$("#Puntos_form").submit();
		}
		else{
			alert('No puedes activar un profesional sin asignar puntos antes.');
		}
	}
}

var procesar_puntos_y_siguiente = function(){
	$("#Siguiente").val(1);
	procesar_puntos();
}
$(document).ready(function() {
    $("a#NewComment").fancybox({
        'type': 'ajax',
        'width': 750,
        'autoDimensions': false
    });
});
</script>
