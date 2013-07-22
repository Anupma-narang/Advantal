<h2>Acciones sobre el profesional</h2>
<ul>
<?php if ($profesional->profesional_estado_id==1):?>
    <li><?php echo link_to_function(image_tag("tick")."Activar", 'submitForm()')?></li>
    <li><?php echo link_to_function(image_tag("tick")."Activar y siguiente", 'procesar_puntos_y_siguiente()')//echo link_to(image_tag("tick")."Activar","concursos_pendientes/changeStatus?id=".$concurso->id."&estado=2")?></li>
    <li><?php echo link_to(image_tag("email")."Sugerir modificaciones","profesionales_pendientes/rechazar?id=".$profesional->id)?></li>
<?php endif;?>

<?php if($profesional->profesional_estado_id == 2):
    if($letterCount): // && $profesional->getNumeroVotantes()==0)):?>
        <li><?php echo link_to_function(image_tag("revert")."Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este profesional.\')')?></li>
<?php else: ?>
        <li><?php echo link_to(image_tag("revert")."Deshacer estado","profesionalLista/revertStatus?id=".$profesional->id)?></li>
<?php endif; ?>
<?php endif; ?>

</ul>

<ul>
<li class="sf_admin_action_edit"><?php echo link_to("Editar profesional","profesionales_pendientes/edit?id=".$profesional->id)?></li>
<?php echo $helper->linkToDelete($profesional, array(  'params' =>   array(  ),  'confirm' => '¿Estás seguro?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<li> <?php echo link_to('Volver a profesionales pendientes','@profesionales_pendientes')?></li>
</ul>


<script>

var procesar_puntos_y_siguiente = function(){
        $("#Siguiente").val(1);
        submitForm();
}

var submitForm = function(){
    var max_length = CKEDITOR.instances.profesional_active_active_reason.config.txtMaxLength;
   
  $("#Error_max_length_incidencia").hide();
if(CKEDITOR.instances.profesional_active_active_reason.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length)
  {
      //alert(CKEDITOR.instances.profesional_active_active_reason.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);
      //document.getElementById("profesional_reason").submit();
      $("#Error_max_length_incidencia").show();
                return false;
  }
else
  {
      document.getElementById("profesional_reason").submit();
  }
}
</script>
