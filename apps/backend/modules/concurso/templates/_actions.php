<h2>Acciones sobre el concurso</h2>
<ul>
    <?php if ($concurso->concurso_estado_id == 1): ?>
        <li><?php echo link_to_function(image_tag("tick") . "Activar", 'procesar_puntos()')//echo link_to(image_tag("tick")."Activar","concurso/changeStatus?id=".$concurso->id."&estado=2")           ?></li>
        <li><?php echo link_to_function(image_tag("tick") . "Activar y siguiente", 'procesar_puntos_y_siguiente()')//echo link_to(image_tag("tick")."Activar","concurso/changeStatus?id=".$concurso->id."&estado=2")           ?></li>
        <li><?php echo link_to(image_tag("email") . "Sugerir modificaciones", "concurso/rechazar?id=" . $concurso->id) ?></li>
        <!-- <li><?php //echo link_to(image_tag("delete")."Cancelar","concurso/changeStatus?id=".$concurso->id."&estado=6")           ?></li> -->
    <?php elseif ($concurso->concurso_estado_id == 2): ?>
        <li><?php echo link_to(image_tag("tick") . "Poner en Referendum", "concurso/changeStatus?id=" . $concurso->id . "&estado=3") ?></li>

    <?php elseif ($concurso->concurso_estado_id == 3): ?>
        <li><?php echo link_to(image_tag("tick") . "Poner en Deliberación", "concurso/changeStatus?id=" . $concurso->id . "&estado=4") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 4): ?>
        <li><?php echo link_to(image_tag("tick") . "Poner en Observación", "concurso/changeStatus?id=" . $concurso->id . "&estado=5")//"concurso/observer?id=".$concurso->id."&estado=5")           ?></li>
        <li><?php echo link_to(image_tag("error") . "Rechazar concurso", "concurso/changeStatus?id=" . $concurso->id . "&estado=7") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 5): ?>
    <?php elseif ($concurso->concurso_estado_id == 6): ?>
    <?php elseif ($concurso->concurso_estado_id == 7): ?>
    <?php elseif ($concurso->concurso_estado_id == 8): ?>
    <?php elseif ($concurso->concurso_estado_id == 9): ?>
    <?php endif; ?>
    <?php if (($concurso->concurso_estado_id == 5) || ($concurso->concurso_estado_id == 4)): ?>
        <li><?php echo link_to(image_tag("error") . "Cerrar concurso", "concurso/changeStatus?id=" . $concurso->id . "&estado=6") ?></li>
    <?php endif; ?>	
    <?php if (($concurso->concurso_estado_id != 8) /* && ($concurso->concurso_estado_id!=4) */): ?>
        <li><?php echo link_to(image_tag("delete") . "Anular concurso", "concurso/changeStatus?id=" . $concurso->id . "&estado=8") ?></li>
    <?php endif; ?>
    <?php if (($concurso->concurso_estado_id != 10) && ($concurso->concurso_estado_id != 8) && ($concurso->concurso_estado_id != 6) && ($concurso->concurso_estado_id != 7) && ($concurso->concurso_estado_id != 9)): ?>
        <li><?php echo link_to(image_tag("error") . "Poner en Revisión", "concurso/changeStatus?id=" . $concurso->id . "&estado=10") ?></li>
    <?php elseif ($concurso->concurso_estado_id == 10): ?>
        <?php if ($concurso->getRevisionLastStateId() && $last_state = Doctrine::getTable('ConcursoEstado')->findOneBy('id', $concurso->getRevisionLastStateId())): ?>
            <li><?php echo link_to(image_tag("tick") . "Reactivar", "concurso/changeStatus?id=" . $concurso->id . "&estado=" . $last_state->getId()) ?></li>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (in_array($concurso->concurso_estado_id, array(5, 6, 7, 8)) || ($concurso->concurso_estado_id == 3 && $concurso->getNumeroVotantes() == 0)): ?>
        <li><?php echo link_to(image_tag("revert") . "Deshacer estado", "concurso/revertStatus?id=" . $concurso->id) ?></li>
    <?php elseif (in_array($concurso->concurso_estado_id, array(1, 2, 10))): ?>
    <?php else: ?>
        <li><?php echo link_to_function(image_tag("revert") . "Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este concurso\')') ?></li>
    <?php endif ?>

    <?php //if (in_array($concurso->concurso_estado_id, array(3, 4, 5, 6, 7, 8, 9))): ?>
  <!--<li><?php //echo link_to(image_tag("revert") . "Deshacer estado", "concurso/revertStatus?id=" . $concurso->id)           ?></li>-->
    <?php //endif ?>

    <?php //if (in_array($concurso->concurso_estado_id, array(5, 6, 7, 8)) || ($concurso->concurso_estado_id == 3 && $concurso->getNumeroVotantes() == 0)): ?>
<!--<li><?php //echo link_to(image_tag("revert") . "Deshacer estado", "concurso/revertStatus?id=" . $concurso->id)           ?></li>
    <?php // else: ?>
<li><?php //echo link_to_function(image_tag("revert") . "Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este concurso\')')           ?></li>-->
    <?php //endif ?>

    <?php if ($concurso->concurso_estado_id == 8): ?>
        <li><?php echo link_to('Añadir comentario', "concurso/newComentario?id=" . $concurso->id) ?></li>
    <?php endif; ?>

</ul>

<?php if (in_array($concurso->concurso_estado_id, array(2, 3))): ?>
    <?php $tiempos = array(1 => " la semana", 2 => "l mes", 3 => "l año") ?>
    <?php $tiempo = array(1 => " la semana", 2 => "l mes", 3 => "l año") ?>

    <?php $tiempos_iconos = array(1 => "check_green.gif", 2 => "check_blue.gif", 3 => "check_red.gif") ?>
    <ul>    

        <?php if ($concurso->isConcursoDestacadoTiempo(1) or $concurso->isConcursoDestacadoTiempo(2) or $concurso->isConcursoDestacadoTiempo(3)): ?>
            <?php if ($concurso->isConcursoDestacadoTiempo(1)): ?>
                <li><?php echo link_to_function("Destacar concurso", "alert('Este concurso ya es el destacado de$tiempo[1].')") ?></li>
            <?php elseif ($concurso->isConcursoDestacadoTiempo(2)): ?>
                <li><?php echo link_to_function("Destacar concurso", "alert('Este concurso ya es el destacado de$tiempo[2].')") ?></li>
            <?php else: ?>
                <li><?php echo link_to_function("Destacar concurso", "alert('Este concurso ya es el destacado de$tiempo[3].')") ?></li>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($concurso->destacado): ?>
                <li><?php echo image_tag('info-icon') ?><strong>¡Concurso destacado!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=normal&concurso_id=" . $concurso->id) ?></li>
            <?php else: ?>
                <?php if ($n_concursos_destacados < 10): ?>
                    <li><?php echo link_to("Destacar concurso", "concurso/destacar?tipo=normal&concurso_id=" . $concurso->id) ?></li>
                <?php else: ?>
                    <li><?php echo link_to_function("Destacar concurso", "alert('No puedes destacar más de 10 concursos a la vez.')") ?></li>
                <?php endif; ?>
            <?php endif; ?>	
        <?php endif; ?>    
        <?php if ($concurso->destacado): ?>
            <li><?php echo link_to_function("Poner como concurso de$tiempo[1]", "alert('Este concurso ya está destacado.')") ?></li>
            <li><?php echo link_to_function("Poner como concurso de$tiempo[2]", "alert('Este concurso ya está destacado.')") ?></li>
            <li><?php echo link_to_function("Poner como concurso de$tiempo[3]", "alert('Este concurso ya está destacado.')") ?></li>
        <?php else: ?>
            <?php if ($concurso->isConcursoDestacadoTiempo(1)): ?>
                <li><?php echo image_tag($tiempos_iconos[1]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[1] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 1 . "&concurso_id=" . $concurso->id) ?></li>

                <li><?php echo link_to_function("Poner como concurso de$tiempo[2]", "alert('Este concurso ya es el destacado de$tiempo[1].')") ?></li>

                <li><?php echo link_to_function("Poner como concurso de$tiempo[3]", "alert('Este concurso ya es el destacado de$tiempo[1].')") ?></li>

            <?php elseif ($concurso->isConcursoDestacadoTiempo(2)): ?>
                <li><?php echo link_to_function("Poner como concurso de$tiempo[1]", "alert('Este concurso ya es el destacado de$tiempo[2].')") ?></li>

                <li><?php echo image_tag($tiempos_iconos[2]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[2] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 2 . "&concurso_id=" . $concurso->id) ?></li>

                <li><?php echo link_to_function("Poner como concurso de$tiempo[3]", "alert('Este concurso ya es el destacado de$tiempo[2].')") ?></li>

            <?php elseif ($concurso->isConcursoDestacadoTiempo(3)): ?>
                <li><?php echo link_to_function("Poner como concurso de$tiempo[1]", "alert('Este concurso ya es el destacado de$tiempo[3].')") ?></li>

                <li><?php echo link_to_function("Poner como concurso de$tiempo[2]", "alert('Este concurso ya es el destacado de$tiempo[3].')") ?></li>

                <li><?php echo image_tag($tiempos_iconos[3]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[3] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 3 . "&concurso_id=" . $concurso->id) ?></li>

            <?php else: ?>
                <?php if ($concurso->isConcursoDestacadoTiempo(1)): ?>
                    <li><?php echo image_tag($tiempos_iconos[1]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[1] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 1 . "&concurso_id=" . $concurso->id) ?></li>
                <?php else: ?>
                    <?php if ($n_concursos_destacados_tiempo[1] == 0): ?>
                        <li><?php echo link_to("Poner como concurso de$tiempo[1]", "concurso/destacar?tipo=temporal&tiempo=" . 1 . "&concurso_id=" . $concurso->id) ?></li>
                    <?php else: ?>
                        <li><?php echo link_to_function("Poner como concurso de$tiempo[1]", "alert('No puedes destacar más de 1 concurso de$tiempo[1] a la vez.')") ?></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($concurso->isConcursoDestacadoTiempo(2)): ?>
                    <li><?php echo image_tag($tiempos_iconos[2]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[2] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 2 . "&concurso_id=" . $concurso->id) ?></li>
                <?php else: ?>
                    <?php if ($n_concursos_destacados_tiempo[2] == 0): ?>
                        <li><?php echo link_to("Poner como concurso de$tiempo[2]", "concurso/destacar?tipo=temporal&tiempo=" . 2 . "&concurso_id=" . $concurso->id) ?></li>
                    <?php else: ?>
                        <li><?php echo link_to_function("Poner como concurso de$tiempo[2]", "alert('No puedes destacar más de 1 concurso de$tiempo[2] a la vez.')") ?></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($concurso->isConcursoDestacadoTiempo(3)): ?>
                    <li><?php echo image_tag($tiempos_iconos[3]) ?><strong>¡Este es el concurso destacado de<?php echo $tiempo[3] ?>!</strong> <?php echo link_to("Quitar destacado", "concurso/retirar?tipo=temporal&tiempo=" . 3 . "&concurso_id=" . $concurso->id) ?></li>
                <?php else: ?>
                    <?php if ($n_concursos_destacados_tiempo[3] == 0): ?>
                        <li><?php echo link_to("Poner como concurso de$tiempo[3]", "concurso/destacar?tipo=temporal&tiempo=" . 3 . "&concurso_id=" . $concurso->id) ?></li>
                    <?php else: ?>
                        <li><?php echo link_to_function("Poner como concurso de$tiempo[3]", "alert('No puedes destacar más de 1 concurso de$tiempo[3] a la vez.')") ?></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>  

    </ul>
<?php endif; ?>

<ul>
    <li class="sf_admin_action_edit"><?php echo link_to("Editar concurso", "concurso/edit?id=" . $concurso->id) ?></li>
    <li class="sf_admin_action_edit">
        <?php if (!$concurso->getFeatured()): ?>
            <?php echo link_to(__('Home', array(), 'messages'), 'concurso/setFeatured?id=' . $concurso->getId(), array('class' => 'featured ', 'data-val' => ($concurso->getEmpresaId() ? 1 : 0))) ?>
        <?php else: ?>
            <?php echo link_to(__('Quitar Home', array(), 'messages'), 'concurso/removeFeatured?id=' . $concurso->getId(), array('class' => 'remove')) ?>
        <?php endif; ?>
    </li>
    <li class="sf_admin_action_featured_order">
        <?php if ($concurso->getEmpresaId()): ?>
            <?php echo link_to(__('Orden Home', array(), 'messages'), 'concurso/setCompanyFeaturedOrder?id=' . $concurso->getId(), array()) ?>
        <?php else: ?>
            <?php echo link_to(__('Orden Home', array(), 'messages'), 'concurso/setProductFeaturedOrder?id=' . $concurso->getId(), array()) ?>
        <?php endif; ?>

    </li>
    <?php echo $helper->linkToDelete($concurso, array('params' => array(), 'confirm' => '¿Estás seguro?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>

    <li> <?php echo link_to('volver a concursos', '@concurso') ?></li>
</ul>


<script>
    var procesar_puntos = function(){
        var points = $('#Otro_puntos').val();
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
      else{
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
