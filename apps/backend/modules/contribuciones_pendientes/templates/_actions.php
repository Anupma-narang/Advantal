<h2>Acciones sobre la contribución</h2>

<ul>
    <?php if ($contribucion->contribucion_estado_id == 1): ?>
        <li><?php echo link_to_function(image_tag("tick") . "Activar", 'procesar_puntos()')//link_to(image_tag("tick")."Poner como activa","contribuciones_pendientes/changeStatus?id=".$contribucion->id."&estado=2")   ?></li>
        <li><?php echo link_to_function(image_tag("tick") . "Activar y siguiente", 'procesar_puntos_y_siguiente()')//echo link_to(image_tag("tick")."Activar","concurso/changeStatus?id=".$concurso->id."&estado=2")   ?></li>
        <li><?php echo link_to(image_tag("email") . "Sugerir Modificaciones", "contribuciones_pendientes/rechazar?id=" . $contribucion->id) ?></li>
    <?php endif; ?>
</ul>


<?php if ($contribucion->contribucion_estado_id == 2): ?>
    <ul>	
        <?php if ($contribucion->destacado): ?>
            <li><?php echo image_tag('/images/info-icon.png') ?><strong>¡Contribucion destacada!</strong></li>
            <li><?php echo link_to("Quitar destacado", "contribuciones_pendientes/retirar?contribucion_id=" . $contribucion->id) ?></li>
        <?php else: ?>
            <?php if ($n_contribuciones_destacados < 10): ?>
                <li><?php echo link_to("Destacar contribucion", "contribuciones_pendientes/destacar?contribucion_id=" . $contribucion->id) ?></li>
            <?php else: ?>
                <li><?php echo link_to_function("Destacar contribucion", "alert('No puedes destacar más de 10 contribuciones por concurso a la vez.')") ?></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
<?php endif; ?>

<ul>
    <li class="sf_admin_action_edit"><?php echo link_to("Editar contribucion", "contribuciones_pendientes/edit?id=" . $contribucion->id) ?></li>
    <?php echo $helper->linkToDelete($contribucion, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    <li><?php echo link_to('Volver al concurso', 'concurso/show?id=' . $contribucion->getConcursoId()) ?></li>
    <li><?php echo link_to('Volver al Listado', 'contribuciones_pendientes') ?></li>
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
                alert('No puedes activar una contribución sin asignar puntos antes.');
            }
            
            /* if(valido){
                $("#Puntos_form").submit();
            }
            else {
                alert('No puedes activar una contribución sin asignar puntos antes.');
            } */
        }
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

    var procesar_puntos_y_siguiente = function(){
        $("#Siguiente").val(1);
        procesar_puntos();
    }
</script>