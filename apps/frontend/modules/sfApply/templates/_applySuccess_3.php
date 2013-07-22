<div class="border-box">
    <div class="top-left">
        <div class="top-right">
            <h2>
                <?php echo link_to(__('Deseo ser informado cada vez que...'), "popup/deseoserinformadocadavezque", array('style' => 'font-size:18px', "popup" => array("popWindow", "width=650,height=500, left=200"))) ?>
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
                        <td width="1%"></td>
                        <td><?php echo $form['colaborador_contribuye_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td>
                            
                            <?php echo $form['colaborador_contribuye_value']->render() ?>
                            <?php echo $form['colaborador_contribuye_value']->renderLabel() ?>
                        </td>
                        <td></td>
                    </tr>
                    <!-- CONCURSO ENTIDAD  -->
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['concurso_empresa_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td>
                            <div style="float:left;margin-right: 4px;"><?php echo $form['concurso_empresa_value']->render(); ?></div>
                            <div style="float:left; margin-top: -3px;width: 95%;">
                                <?php echo $form['concurso_empresa_value']->renderLabel(); ?>
                                
                                    <?php $concurso_empresa_nombreError = (($form['concurso_empresa_nombre']->hasError()) ? 'errorstudy' : ''); ?>
                                    <?php echo $form['concurso_empresa_nombre']->render(array('class' => 'tamano_20_c ' . $concurso_empresa_nombreError)); ?>&nbsp;
                                
                                        <?php echo __('en') ?>&nbsp;
                                            
                                            <?php $concurso_empresa_provincia_idError = (($form['concurso_empresa_provincia_id']->hasError()) ? 'errorstudy' : '');?>
                                            <?php echo $form['concurso_empresa_provincia_id']->render(array('class' =>  $concurso_empresa_provincia_idError)); ?>&nbsp;
                                <?php echo __('en la localidad de') ?>&nbsp;
                                    <?php $concurso_empresa_ciudad_idError = (($form['concurso_empresa_ciudad_id']->hasError()) ? 'errorstudy' : ''); ?>
                                    <?php echo $form['concurso_empresa_ciudad_id']->render(array('class' =>  $concurso_empresa_ciudad_idError)); ?>
                            </div>
                        </td>
                    </tr>
                    <!-- CONCURSO PRODUCTO  -->
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['concurso_producto_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['concurso_producto_value']->render() ?>
                            <?php echo $form['concurso_producto_value']->renderLabel() ?>
                            <?php $concurso_producto_nombreError = (($form['concurso_producto_nombre']->hasError()) ? 'errorstudy' : ''); ?>
                            <?php $concurso_producto_marcaError = (($form['concurso_producto_marca']->hasError()) ? 'errorstudy' : ''); ?>
                            <?php echo $form['concurso_producto_nombre']->render(array('class' => 'tamano_20_c ' . $concurso_producto_nombreError)) ?>&nbsp;<?php echo __('de la marca') ?>&nbsp;<?php echo $form['concurso_producto_marca']->render(array('class' => 'tamano_20_c ' . $concurso_producto_marcaError)) ?>
                        </td>
                    </tr>
                    <!-- LISTA BLANCA  -->
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['lista_blanca_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['lista_blanca_value']->render() ?>
                            <?php echo $form['lista_blanca_value']->renderLabel() ?>
                        </td>
                        <td></td>
                    </tr>
                    <!-- LISTA NEGRA  -->
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['lista_negra_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['lista_negra_value']->render() ?>
                            <?php echo $form['lista_negra_value']->renderLabel() ?>
                        </td>
                        <td></td>
                    </tr>
                    <!-- LISTA NEGRA  -->
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['publica_profesional_value']->renderError() ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="1%"></td>
                        <td><?php echo $form['publica_profesional_value']->render() ?>
                            <?php echo $form['publica_profesional_value']->renderLabel() ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>


                    <tr>
                        <td colspan="3">
                            <?php if ($form['acept_conditions']->getError()): ?>
                                <ul class="error_list barra_mediana_grande">
                                    <li><?php echo $form['acept_conditions']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <?php echo image_tag('/images/atention-icon.png', array('style' => 'float:left; margin: 3px;')) ?>
                            <?php echo $form['acept_conditions']->render() ?>
                            <?php echo link_to('He leído', 'nosotros/terminosycondiciones', array('target' => '_blank')) . ' y acepto los términos y condiciones de servicio de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>*.' ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center"><br />
                            <span class="resaltar" style="width: 180px; margin:auto;">
                                <input type="submit" id="backStep" name="_back" value="<?php echo __('anterior') ?>" class="red_button" />
                            </span>
                            <div class="resaltar" style="width: 180px; margin:auto;">
                                <input type="submit" id="nextStep" value="<?php echo __('crea una cuenta') ?>" class="red_button" />
                            </div>formulario
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
    select.errorstudy,
    input.errorstudy{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>
<script type="text/javascript">
    $('form').bind('keypress', function(e) {
        if (e.keyCode == 13) {
            $('#nextStep').click();
        }
    });
    $("#nextStep").click(function() {
        $(this).removeClass("red_button");
        $(this).addClass("gray_button");
        $(this).attr('disabled', 'disabled');
        $('form').submit();
    });
    $(document).ready(function() {
        if ($("#sfApplyForm3_concurso_empresa_provincia_id").val() == 16) { // Ceuta
            $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=5884]").attr("selected", true); // Ceuta
            $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
        }
        else if ($("#sfApplyForm3_concurso_empresa_provincia_id").val() == 35) { // Melilla
            $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=5885]").attr("selected", true); // Melilla
            $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
        }
        else if ($("#sfApplyForm3_concurso_empresa_provincia_id").val() == 1) { // Todas
            $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=8113]").attr("selected", true);
            $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
        }

        $("#sfApplyForm3_concurso_empresa_provincia_id").change(function() {
            if ($(this).val() == 16) {	// Ceuta
                setTimeout(function() {
                    $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=5884]").attr("selected", true); // Ceuta
                    $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                }, 50);
            }
            else if ($(this).val() == 35) {	// Melilla
                setTimeout(function() {
                    $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=5885]").attr("selected", true); // Melilla
                    $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                }, 50);
            }
            else if ($(this).val() == 1) {	// Todas
                setTimeout(function() {
                    $("#sfApplyForm3_concurso_empresa_ciudad_id option[value=8113]").attr("selected", true);
                    $("#sfApplyForm3_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                }, 50);
            }
        });

        $("#sfApplyForm3_concurso_producto_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca') ?>", {width: 260, selectFirst: false});
        $("#sfApplyForm3_concurso_producto_nombre").autocomplete("<?php echo url_for('ajax_get/productos_by_nombre') ?>", {width: 260, selectFirst: false});
        $("#sfApplyForm3_concurso_empresa_nombre").autocomplete("<?php echo url_for('ajax_get/empresas_by_nombre') ?>", {width: 260, selectFirst: false});
    });
</script>