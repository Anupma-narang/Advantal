<h2>Acciones sobre la carta</h2>
<ul>
<?php if ($cartas->profesional_letter_estado_id==1):?>
	<li><?php echo link_to_function(image_tag("tick")."Activar", 'submitForm()')?></li>
    <li><?php echo link_to_function(image_tag("tick")."Activar y siguiente", 'procesar_puntos_y_siguiente()')//echo link_to(image_tag("tick")."Activar","concursos_pendientes/changeStatus?id=".$concurso->id."&estado=2")?></li>
	<li><?php echo link_to(image_tag("email")."Sugerir modificaciones","cartas_pendientes/rechazar?id=".$cartas->id)?></li>
<?php elseif($cartas->profesional_letter_estado_id==2):?>
    <li><?php echo link_to(image_tag("tick")."Poner en Referendum","cartas_pendientes/changeStatus?id=".$cartas->id."&estado=3")?></li>
<?php elseif($cartas->profesional_letter_estado_id==3):?>
		<li><?php echo link_to(image_tag("tick")."Poner en Deliberación","cartas_pendientes/changeStatus?id=".$cartas->id."&estado=4")?></li>
<?php elseif($cartas->profesional_letter_estado_id==4):?>
	<li><?php echo link_to(image_tag("tick")."Poner en Observación","cartas_pendientes/changeStatus?id=".$cartas->id."&estado=5")?></li>
	<li><?php echo link_to(image_tag("error")."Rechazar Profesionales","cartas_pendientes/changeStatus?id=".$cartas->id."&estado=7")?></li>
<?php elseif($cartas->profesional_letter_estado_id==5):?>
<?php elseif($cartas->profesional_letter_estado_id==6):?>
<?php elseif($cartas->profesional_letter_estado_id==7):?>
<?php elseif($cartas->profesional_letter_estado_id==8):?>
<?php elseif($cartas->profesional_letter_estado_id==9):?>
<?php endif;?>
<?php if(($cartas->profesional_letter_estado_id==5) || ($cartas->profesional_letter_estado_id==4)):?>
	<li><?php echo link_to(image_tag("error")."Cerrar carta","cartas_pendientes/changeStatus?id=".$cartas->id."&estado=6")?></li>
<?php endif;?>
<?php if(in_array($cartas->profesional_letter_estado_id, array(2))):?>
	<li><?php echo link_to(image_tag("revert")."Deshacer estado","cartas_pendientes/revertStatus?id=".$cartas->id)?></li>
<?php endif ?>
</ul>
<ul>
<li class="sf_admin_action_edit">
<?php echo link_to("Editar carta",url_for('@profesional_carta_pendientes_create?id='.$cartas->getProfesionalId().'&letter_id='.$cartas->getId()))?></li>
<?php echo $helper->linkToDelete($cartas, array(  'params' =>   array(  ),  'confirm' => '¿Estás seguro?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<li> <?php echo link_to('Volver a cartas pendientes','@cartas_pendientes')?></li>
</ul>


<script>
/*var procesar_puntos = function(){

	var valido = false;
	$('input:checkbox').each(function(){
		if($(this).attr("checked") == "checked"){
			console.log('si');
			valido = true;
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
		else {
			alert('No puedes activar una carta sin asignar puntos antes.');
		}
	}
}*/
var procesar_puntos_y_siguiente = function(){
	$("#Siguiente").val(1);
	submitForm();
}


var submitForm = function(){
document.getElementById("Puntos_form").submit();
}

/*$(document).ready(function() {
    $("a#NewComment").fancybox({
        'type': 'ajax',
        'width': 750,
        'autoDimensions': false
    });
});*/
</script>
