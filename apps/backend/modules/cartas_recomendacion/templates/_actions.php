<h2>Acciones sobre la carta</h2>
<ul>
<?php if ($concurso->profesional_letter_estado_id==1):?>
	<li><?php echo link_to_function(image_tag("tick")."Activar", 'submitForm()')?></li>
	<li><?php echo link_to(image_tag("email")."Sugerir modificaciones","cartas_recomendacion/rechazar?id=".$concurso->id)?></li>
<?php endif;?>

<?php if(in_array($concurso->profesional_letter_estado_id, array(2))): // && $profesional->getNumeroVotantes()==0)):?>
    <li><?php echo link_to(image_tag("revert")."Deshacer estado","cartas_recomendacion/revertStatus?id=".$concurso->id)?></li>
<?php else: ?>
    <li><?php echo link_to_function(image_tag("revert")."Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este recomendación.\')')?></li>
<?php endif ?>
<ul>
<li class="sf_admin_action_edit">

<?php echo link_to("Editar recomendación",url_for('@profesional_cartas_recomendacion_create?id='.$concurso->getProfesionalId().'&letter_id='.$concurso->getId()))?></li>
<?php echo $helper->linkToDelete($concurso, array(  'params' =>   array(  ),  'confirm' => '¿Estás seguro?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<li> <?php echo link_to('volver a cartas recomendación','@profesional_letter_cartas_recomendacion')?></li>
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
			alert('No puedes activar un profesional sin asignar puntos antes.');
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
