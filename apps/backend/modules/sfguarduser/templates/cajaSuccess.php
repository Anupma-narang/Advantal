<div id="sf_admin_container">
    <h1>Asignación de Caja</h1>
    <h3><?php echo $contributor->getUsername() ?></h3>
    <div id="Asignacion_puntos_content">
        <div id="Asignacion_puntos_inner">
            <form id="Puntos_form" action="<?php echo url_for('sfguarduser'); ?>/<?php echo $uid; ?>/caja" method="POST">
                <?php echo $form->renderHiddenFields(); ?>
                <fieldset id="sf_fieldset_none">
                    <div class="sf_admin_form_row">

                        <div>
                            <label><b>Cantidad asignada:</b></label>
                            <div class="content"><?php echo $form['cantidad']->render(array('maxlength' => '10', 'class' => 'tamano_10_c')) ?></div>
                            <?php echo $form['cantidad']->renderError() ?>

                        </div>
                    </div>

                    <div class="sf_admin_form_row">

                        <div>
                            <label>Acción:</label>
                            <div class="content"><?php echo $form['accion']->render() ?></div>
                            <?php echo $form['accion']->renderError() ?>

                        </div>
                    </div>


                    <div class="sf_admin_form_row">

                        <div>
                            <label>Comentarios:</label>
                            <div class="content"><?php echo $form['comentario']->render(array('maxlength' => '70', 'class' => 'tamano_40_c')) ?></div>
                            <?php echo $form['comentario']->renderError() ?>

                        </div>
                    </div>

                </fieldset>

                <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
                    <li class="sf_admin_action_list">
                        <a href="/backend.php/sfguarduser">Volver al Listado</a>
                    </li>
                    <li class="sf_admin_action_save">
                        <input type="button" value="Guardar" id="submit_cmd" />
                    </li>
                </ul>


            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#submit_cmd').bind('click',function(){
        if(<?php echo $contributor->getIsDisabled() ? 1 : 0 ?>){
            alert('No puedes asignar caja a colaboradores dados de baja.');
        }else{
            var cash_value = $('#changecaja_backend_cantidad').val();
            var pos = cash_value.indexOf(',');
            var fractional = '';
            if(pos != -1){
                fractional = cash_value.substr(pos+1,cash_value.length - pos);
                cash_value = cash_value.substr(0,pos);
                console.log(fractional);
       
            }
            cash_value  = cash_value.replace(/\./g,'');
            if(cash_value > 10000000 && $('#changecaja_backend_accion').val() == 1){
                alert('<?php echo __('No puedes asignar una caja superior a 10.000.000 €.') ?>');
            }else if(fractional.length > 4){
                alert('<?php echo __('No puedes asignar más de cuatro decimales.') ?>');
            }else{
                $('#Puntos_form').submit();  
            }
      
        }
    });
</script>