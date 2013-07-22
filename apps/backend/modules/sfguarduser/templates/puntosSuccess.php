<div id="sf_admin_container">
    <h1>Asignación de puntos</h1>
    <h3><?php echo $user->getUsername() ?></h3>
    <form id="Puntos_form" action="<?php echo url_for('sfguarduser/doPuntos?id=' . $user->getId()) ?>" method="get">
        <div id="Asignacion_puntos_content">
            <div id="Asignacion_puntos_inner">

                <input type="hidden" name="estado" value="2">			                                                  
                <table>
                    <tbody>
                        <?php $c = 1 ?>
                        <tr>
                            <td></td>
                            <td><b><?php echo __('Tipo de puntos') ?></b> </td>
                            <td ><select name="point_type">
                                    <option value="1" selected="selected"><?php echo __('Ambos'); ?></option>
                                    <option value="2"><?php echo __('Puntos acumulados'); ?></option>
                                    <option value="3"><?php echo __('Puntos canjeables'); ?></option>
                                </select></td>
                        </tr>
                        <?php foreach ($puntos as $p): ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $p->getCodigo() ?>"
                                           value="true"></td>
                                <td><?php echo $p->getDescripcion() ?></td>
                                <td style="text-align: right;"><strong><?php echo number_format($p->puntos, 0, '.', '.'); ?></strong></td>
                            </tr>			
                            <?php $c++ ?>			
                        <?php endforeach; ?>
                        <tr>
                            <th>Otro</th>
                            <td><input type="text" name="otro_descripcion" size="40" id="Otro_descripcion"></td>
                            <td style="text-align: right;"><input type="text" name="otro_puntos" size="10" id="Otro_puntos"></td>
                        </tr>			
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
        </div>	
        <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
            <li class="sf_admin_action_list">
                <?php echo link_to('Volver al Listado', '@sfguarduser') ?>

            </li>
            <li class="sf_admin_action_save">
                <?php echo button_to_function('Asignar', 'procesar_puntos()') ?>
            </li>
        </ul>
        <input type="hidden" name="user_id" value="<?php echo $user->getId() ?>">
    </form>
</div>

<?php if ($user->getIsDisabled()): ?>
    <script>
        var procesar_puntos = function(){
            alert('No puedes asignar puntos a un usuario dado de baja.');
        }
    </script>
<?php else: ?>
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
                alert('Necesitas seleccionar un concepto o más de asignación de puntos.');
            else if(($("#Otro_descripcion").val()=='') && ($("#Otro_puntos").val()))
                alert('Necesitas seleccionar un concepto o más de asignación de puntos.');
            else if(($("#Otro_descripcion").val()) && ($("#Otro_puntos").val()) && (isNaN($("#Otro_puntos").val())))
                alert('Necesitas seleccionar un concepto o más de asignación de puntos.');
            else {
                if(valido){
                    if(points){
                        var temp = points;
                        temp = temp.replace('.', '');
                        temp = temp.replace(',', '');
                        if(points != number_format(temp,0,',','.')){
                            //alert('Es necesario introducir la cantidad correcta asignado.')
                            alert('Necesitas seleccionar un concepto o más de asignación de puntos.');
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
                    alert('Necesitas seleccionar un concepto o más de asignación de puntos.');
                }
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
    </script>
<?php endif; ?>