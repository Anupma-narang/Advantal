<h2>Acciones sobre el concurso</h2>
<ul>
    <?php if ($concurso->concurso_estado_id == 1): ?>
        <li><?php echo link_to_function(image_tag("/images/icons/Activate.png") . "Activar", 'procesar_puntos()')//echo link_to(image_tag("tick")."Activar","concursos_pendientes/changeStatus?id=".$concurso->id."&estado=2")            ?></li>
        <li><?php echo link_to_function(image_tag("/images/icons/Activate-and-next.png") . "Activar y siguiente", 'procesar_puntos_y_siguiente()')//echo link_to(image_tag("tick")."Activar","concursos_pendientes/changeStatus?id=".$concurso->id."&estado=2")            ?></li>
        <li><?php echo link_to(image_tag("/images/icons/Suggest-changes.png") . "Sugerir modificaciones", "concursos_pendientes/rechazar?id=" . $concurso->id) ?></li>
        <!-- <li><?php //echo link_to(image_tag("delete")."Cancelar","concursos_pendientes/changeStatus?id=".$concurso->id."&estado=6")            ?></li> -->
    <?php elseif ($concurso->concurso_estado_id == 2): ?>
        <li><?php echo link_to(image_tag("/images/icons/Checkmark-1.png") . "Poner en Referendum", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=3") ?></li>

    <?php elseif ($concurso->concurso_estado_id == 3): ?>
        <li><?php echo link_to(image_tag("/images/icons/Checkmark-1.png") . "Poner en Deliberación", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=4") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 4): ?>
        <li><?php echo link_to(image_tag("/images/icons/Checkmark-1.png") . "Poner en Observación", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=5")//"concursos_pendientes/observer?id=".$concurso->id."&estado=5")            ?></li>
        <li><?php echo link_to(image_tag("/images/icons/Reject-contest") . "Rechazar concurso", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=7") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 5): ?>
    <?php elseif ($concurso->concurso_estado_id == 6): ?>
    <?php elseif ($concurso->concurso_estado_id == 7): ?>
    <?php elseif ($concurso->concurso_estado_id == 8): ?>
    <?php elseif ($concurso->concurso_estado_id == 9): ?>
    <?php endif; ?>
    <?php if (($concurso->concurso_estado_id == 5) || ($concurso->concurso_estado_id == 4)): ?>
        <li><?php echo link_to(image_tag("/images/icons/Close-contest.png") . "Cerrar concurso", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=6") ?></li>
    <?php endif; ?>	
    <?php if (($concurso->concurso_estado_id != 8) /* && ($concurso->concurso_estado_id!=4) */): ?>
        <li><?php echo link_to(image_tag("/images/icons/Nulify-contest.png") . "Anular concurso", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=8") ?></li>
    <?php endif; ?>
    <?php if (($concurso->concurso_estado_id != 10) && ($concurso->concurso_estado_id != 8) && ($concurso->concurso_estado_id != 6) && ($concurso->concurso_estado_id != 7) && ($concurso->concurso_estado_id != 9)): ?>
        <li><?php echo link_to(image_tag("/images/icons/Put-in-revision.png") . "Poner en Revisión", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=10") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 10): ?>
        <?php if ($last_state = Doctrine::getTable('ConcursoEstado')->findOneBy('id', $concurso->getRevisionLastStateId())): ?>
            <li><?php echo link_to(image_tag("/images/icons/Reactivate.png") . "Reactivar", "concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=" . $last_state->getId()) ?></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (in_array($concurso->concurso_estado_id, array(3, 4, 5, 6, 7, 8))): ?>
        <li><?php echo link_to(image_tag("revert") . "Deshacer estado", "concursos_pendientes/revertStatus?id=" . $concurso->id) ?></li>
    <?php endif ?>
    <?php if ($concurso->concurso_estado_id == 8): ?>
        <li><?php echo link_to('Añadir comentario', "concursos_pendientes/newComentario?id=" . $concurso->id, array('id' => 'NewComment')) ?></li>
    <?php endif; ?>

</ul>

<?php if (in_array($concurso->concurso_estado_id, array(2, 3))): ?>
    <?php $tiempos = array(1 => " la semana", 2 => "l mes", 3 => "l año") ?>
    <?php $tiempos_iconos = array(1 => "check_green.gif", 2 => "check_blue.gif", 3 => "check_red.gif") ?>
    <ul>
        <?php if ($concurso->destacado): ?>
            <li><?php echo image_tag('info-icon') ?><strong>¡Concurso destacado!</strong> <?php echo link_to("Quitar", "concursos_destacados/retirar?tipo=normal&concurso_id=" . $concurso->id) ?></li>
        <?php else: ?>
            <?php if ($n_concursos_destacados < 10): ?>
                <li><?php echo link_to(image_tag("/images/icons/Highlight-contest.png") . "Destacar concurso", "concursos_destacados/destacar?tipo=normal&concurso_id=" . $concurso->id) ?></li>
            <?php else: ?>
                <li><?php echo link_to_function(image_tag("/images/icons/Highlight-contest.png") . "Destacar concurso", "alert('No puedes destacar más de 10 concursos a la vez')") ?></li>
            <?php endif; ?>
        <?php endif; ?>	
        <?php foreach ($tiempos as $i => $tiempo): ?>
            <?php if ($concurso->isConcursoDestacadoTiempo($i)): ?>
                <li><?php echo image_tag($tiempos_iconos[$i]) ?><strong>¡Este concurso es el destacado de<?php echo $tiempo ?>!</strong> <?php echo link_to("Quitar destacado", "concursos_destacados/retirar?tipo=temporal&tiempo=" . $i . "&concurso_id=" . $concurso->id) ?></li>
            <?php else: ?>			
                <?php if ($n_concursos_destacados_tiempo[$i] == 0): ?>
                    <li><?php echo link_to("Poner como concurso de$tiempo", "concursos_destacados/destacar?tipo=temporal&tiempo=" . $i . "&concurso_id=" . $concurso->id) ?></li>
                <?php else: ?>
                    <li><?php echo link_to_function("Poner como concurso de$tiempo", "alert('No puedes destacar más de 1 concurso de$tiempo a la vez')") ?></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<ul>
    <li class="sf_admin_action_edit"><?php echo link_to("Editar concurso", "concursos_pendientes/edit?id=" . $concurso->id) ?></li>
    <?php echo $helper->linkToDelete($concurso, array('params' => array(), 'confirm' => '¿Estás seguro?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    <?php $module_name = sfContext::getInstance()->getModuleName(); ?>
    <?php if ($module_name == 'concursos_pendientes_empresa'): ?>
        <li> <?php echo link_to('Volver a concursos pendientes', '@concurso_concursos_pendientes_empresa') ?></li>
    <?php elseif ($module_name == 'concursos_pendientes_product'): ?>
        <li> <?php echo link_to('Volver a concursos pendientes', '@concurso_concursos_pendientes_product') ?></li>
    <?php else: ?>
        <li> <?php echo link_to('Volver a concursos pendientes', '@concursos_pendientes') ?></li>
    <?php endif; ?>
</ul>


<script>
    var procesar_puntos = function(){
        var points = $('#Otro_puntos').val();
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
                if(points){
                    var temp = points;
                    temp = temp.replace('.', '');
                    temp = temp.replace(',', '');
                    if(points != number_format(temp,0,',','.')){
                        //alert('Es necesario introducir la cantidad correcta asignado.')
                        alert('Necesitas incluir una descripción y los puntos a asignar.');
                    }else{
                        $('#Otro_puntos').val(temp);
                        $("#Puntos_form").submit();
                    }
                }else{
                    $('#Otro_puntos').val(temp);
                    $("#Puntos_form").submit();
                }
            }
            else{
                alert('No puedes activar un concurso sin asignar puntos antes.');
            }
            
            /* if(valido){
                $("#Puntos_form").submit();
            }
            else {
                alert('No puedes activar un concurso sin asignar puntos antes.');
            } */
        }
    }
    var procesar_puntos_y_siguiente = function(){
        $("#Siguiente").val(1);
        procesar_puntos();
    }
    
    function number_format (number, decimals, dec_point, thousands_sep) {
                  
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    $(document).ready(function() {
        $("a#NewComment").fancybox({
            'type': 'ajax',
            'width': 750,
            'autoDimensions': false
        });
    });
</script>
