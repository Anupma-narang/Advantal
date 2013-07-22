<div class="border-box">
    <div class="top-left">
        <div class="top-right">
            <h2>
                <?php echo __('DATOS PERSONALES') ?>
            </h2>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</div>

<div class="border-box">
    <div class="top-left">
        <div class="top-right">
            <table>
                <tbody>
                    <tr>
                        <th width="264"><?php echo $form['name']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th width="264"><?php echo $form['surname1']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th width="295" colspan="3"><?php echo $form['surname2']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                    </tr>
                    <tr>
                        <td><?php echo $form['name']->renderError() ?></td>
                        <td><?php echo $form['surname1']->renderError() ?></td>
                        <td colspan="3"><?php echo $form['surname2']->renderError() ?></td>
                    </tr>
                    <tr>
                        <?php $nameError = (($form['name']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['name']->render(array('class' => 'tamano_32_c ' . $nameError)) ?></td>
                       
                        <?php $surname1Error = (($form['surname1']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['surname1']->render(array('class' => 'tamano_32_c ' . $surname1Error)) ?></td>
                        
                        <?php $surname2Error = (($form['surname2']->hasError()) ? 'errorreg' : ''); ?>
                        <td colspan="3"><?php echo $form['surname2']->render(array('class' => 'tamano_32_c ' . $surname2Error)) ?></td>
                    </tr>


                    <tr>
                        <th><?php echo $form['sex']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th><?php echo $form['fecha_nac']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th colspan="3"><?php echo $form['formacion_academica_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                    </tr>
                    <tr>
                        <td><?php echo $form['sex']->renderError() ?></td>
                        <td><?php echo $form['fecha_nac']->renderError() ?></td>
                        <td colspan="3"><?php echo $form['formacion_academica_id']->renderError() ?></td>
                    </tr>
                    <tr>
                        <?php $sexError = (($form['sex']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['sex']->render(array('class' => $sexError)) ?></td>
                        
                        <?php $fecha_nacError = (($form['fecha_nac']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['fecha_nac']->render(array('class' => $fecha_nacError)) ?></td>
                        
                        
                        <?php $formacion_academica_idError = (($form['formacion_academica_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td colspan="3"><?php echo $form['formacion_academica_id']->render(array('class' => 'fomacion_academica '.$formacion_academica_idError )) ?>
                        </td>
                    </tr>


                    <tr>
                        <th colspan="2"><?php echo $form['colaborador_nivel_uno_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th colspan="3"><?php echo $form['colaborador_nivel_dos_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if ($form['colaborador_nivel_uno_id']->getError()): ?>
                                <ul class="error_list barra_mediana">
                                    <li><?php echo $form['colaborador_nivel_uno_id']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td colspan="3"><?php echo $form['colaborador_nivel_dos_id']->renderError() ?>
                        </td>
                    </tr>
                    <tr>
                         <?php $colaborador_nivel_uno_idError = (($form['colaborador_nivel_uno_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td colspan="2"><?php echo $form['colaborador_nivel_uno_id']->render(array('class' => $colaborador_nivel_uno_idError )) ?>
                        </td>
                         <?php $colaborador_nivel_dos_idError = (($form['colaborador_nivel_dos_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td colspan="3"><?php echo $form['colaborador_nivel_dos_id']->render(array('class' => $colaborador_nivel_dos_idError )) ?>
                        </td>
                    </tr>


                    <tr>
                        <th><?php echo $form['road_type_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th><?php echo $form['direccion']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th width="110"><?php echo $form['numero']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th width="95"><?php echo $form['piso']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th><?php echo $form['puerta']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                    </tr>
                    <tr>
                        <td><?php echo $form['road_type_id']->renderError() ?></td>
                        <td><?php echo $form['direccion']->renderError() ?></td>
                        <td><?php echo $form['numero']->renderError() ?></td>
                        <td><?php echo $form['piso']->renderError() ?></td>
                        <td><?php echo $form['puerta']->renderError() ?></td>
                    </tr>
                    <tr>
                        <?php $road_type_idError = (($form['road_type_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['road_type_id']->render(array('class' =>'select_pequeño '. $road_type_idError )) ?></td>
                        
                        <?php $direccionError = (($form['direccion']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['direccion']->render(array('class' =>'tamano_32_c '. $direccionError )) ?></td>
                        
                        <?php $numeroError = (($form['numero']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['numero']->render(array('class' =>'tamano_4_c '. $numeroError )) ?></td>
                        
                        <?php $pisoError = (($form['piso']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['piso']->render(array('class' =>'tamano_2_c '. $pisoError )) ?></td>
                        
                        <?php $puertaError = (($form['puerta']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['puerta']->render(array('class' =>'tamano_4_c '. $puertaError )) ?></td>
                    </tr>


                    <tr>
                        <th><?php echo $form['cp']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th><?php echo $form['states_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                        <th colspan="3"><?php echo $form['city_id']->renderLabel(null, array('class' => 'bundle')) ?>
                        </th>
                    </tr>
                    <tr>
                        <td><?php echo $form['cp']->renderError() ?></td>
                        <td><?php echo $form['states_id']->renderError() ?></td>
                        <td colspan="3"><?php echo $form['city_id']->renderError() ?></td>
                    </tr>
                    <tr>
                        <?php $cpError = (($form['cp']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['cp']->render(array('class' =>'c_p '. $cpError )) ?></td>
                        
                        <?php $states_idError = (($form['states_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td><?php echo $form['states_id']->render(array('class' =>$states_idError )) ?></td>
                        
                        <?php $city_idError = (($form['city_id']->hasError()) ? 'errorreg' : ''); ?>
                        <td colspan="3"><?php echo $form['city_id']->render(array('class' => 'select_mediano '.$city_idError)) ?></td>
                    </tr>

                    <tr>
                        <td colspan="5"><hr></td>
                    </tr>

                    <tr>
                        <td colspan="5" style="text-align: center"><br />
                            <span class="resaltar" style="width: 180px; margin:auto;">
                                <input type="submit" id="backStep" name="_back" value="<?php echo __('anterior') ?>" class="red_button" />
                            </span>
                            <span class="resaltar" style="width: 180px; margin:auto;">
                                <input type="submit" id="nextStep" value="<?php echo __('última') ?>" class="red_button" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><br /> <br /> <strong><?php echo __('* Datos requeridos') ?>
                            </strong>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</div>

<style type="text/css">
     input.c_p{
    width: 40px;
    }
    select.errorreg,
    input.errorreg{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
       form#sf_apply_apply_form input {
        
        font-family: arial !important;
    font-size: 14px;
       }
</style>

<script type="text/javascript">
    $("#nextStep").click(function() {
        $(this).removeClass("red_button");
        $(this).addClass("gray_button");
        $(this).attr('disabled', 'disabled');
        $('form').submit();
    });

    $('form').bind('keypress', function(e) {
        if (e.keyCode == 13) {
            $('#nextStep').click();
        }
    });
    

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
                            foreach (StatesTable::getCiudadesAutonomas() as $city)
                                printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
                                ?>

        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    function disable_nivel2(f, g) {
<?php // Amas de casa(22),Desempleados(23),Estudiantes(24) y otros(25)     ?>
        g.attr("disabled", f.val() == 22 || f.val() == 23 || f.val() == 24 || f.val() == 25);
    }

    $(document).ready(function() {
        $("form").bind("submit",function(){$("#sfApplyForm2_city_id").removeAttr("disabled");});
        $("#sfApplyForm2_states_id").change(function() {
            ceuta_melilla($(this), $("#sfApplyForm2_city_id"))
        });
        //$("#sf_apply_apply_form").bind("submit",function(){$("#sfApplyForm2_city_id").removeAttr("disabled");});
        $("#sfApplyForm2_colaborador_nivel_uno_id").bind("change", function() {
            disable_nivel2($(this), $("#sfApplyForm2_colaborador_nivel_dos_id"));
        });
        ceuta_melilla($("#sfApplyForm2_states_id"), $("#sfApplyForm2_city_id"));
        disable_nivel2($("#sfApplyForm2_colaborador_nivel_uno_id"), $("#sfApplyForm2_colaborador_nivel_dos_id"));
    });
</script>