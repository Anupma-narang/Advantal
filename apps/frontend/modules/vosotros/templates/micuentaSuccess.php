<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php include_stylesheets_for_form($form) ?>

<?php use_helper('mihelper') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>
<?php $user_profile = $sf_user->getGuardUser()->getProfile(); ?>
<style type="text/css">
    .form_login select {
        font-family: "Trebuchet MS","Lucida Sans Unicode","Lucida Grande",Verdana;
        font-size: 14px;
    }
    .perfilIMG{
        position: absolute;
        right: 13px;
        top: 16px;
    }
    .image-set{
        position: relative;
    }
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        .perfilIMG{
            position: absolute;
            right: -1px;
            top: -76px;
        }
    }
</style>
<div id="content_vosotros">
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mi cuenta', 'tituloSeccion' => 'Mi cuenta')) ?>

    <div style="float: left; margin: 10px;"><?php echo link_to('vuelve a auditoscopia', '@homepage') ?></div>
    <div style="clear:both"></div>
    <div id="formUser">
        <?php if ($sf_user->hasFlash('errormicuenta')): ?>
            <ul class="error_list">
                <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errormicuenta', ESC_RAW) ?></li>
            </ul>
        <?php endif; ?>
        <form class="form_login" id="formulario" method="POST" action="<?php echo url_for("vosotros/micuenta") ?>#mid" name="sf_apply_settings_form" id="sf_apply_settings_form" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php echo $form->renderGlobalErrors() ?>
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <h2>
                            <?php echo __('DATOS DE COLABORADOR') ?>
                        </h2>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
            <div class="border-box image-set">
                <div class="top-left">
                    <div class="top-right">
                        <table width="694">
                            <tbody>
                                <tr>
                                    <td width="35%"><label class="bundle">Mi correo electrónico</label></td>
                                    <td width="65%"><?php echo $sf_user->getGuardUser()->getEmailAddress() ?></td>

                                </tr>
                                <tr>
                                    <td><label class="bundle">Mi Usuario/Alias</label></td>
                                    <td><?php echo $sf_user->getGuardUser()->getUserName() ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $form['image']->renderError() ?></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top"><?php echo $form['image']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                    <td valign="top"><?php echo $form['image']->render() ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align:top">
                                        <?php echo button_to_function('cambia tu contraseña', 'change_password()', array('id' => 'Change_pass_button')) ?>
                                        <a href="#" ><?php echo button_to_function('hacer caja', '', array('id' => 'caja_button', 'title' => 'Hacer caja')) ?></a>
                                        <a href="#caja_dialog_box" id="caja_box" class="hidden">&nbsp;</a>
                                        <div id="Pass_Preload" class="preload" style="display:none"><?php echo image_tag('/images/preloader-mini.gif') ?></div>
                                        <div id="Pass_Ok" class="preload" style="display:none"><?php echo image_tag('/images/ok_icon_20.png') ?></div>
                                        <div id="Pass_Error" class="preload" style="display:none"><?php echo image_tag('/images/error_icon_20.png') ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div id="ChangePass_form"></div>
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
                        <table width="694" border="0">
                            <tr>
                                <td width="241"><label class="bundle">Mi nombre</label></td>
                                <td width="437"><?php echo $user_profile->getName() ?></td>
                            </tr>
                            <tr>
                                <td><label class="bundle">Mi apellido 1</label></td>
                                <td><?php echo $user_profile->getSurname1() ?></td>
                            </tr>
                            <tr>
                                <td><label class="bundle">Mi apellido 2</label></td>
                                <td><?php echo $user_profile->getSurname2() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $form['sex']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $form['fecha_nac']->renderLabel(null, array('class' => 'bundle')) ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $form['sex']->renderError() ?></td>
                                <td><?php echo $form['fecha_nac']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php
                                $sexError = '';
                                if ($form['sex']->hasError()) {
                                    $sexError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $fecha_nacError = '';
                                if ($form['fecha_nac']->hasError()) {
                                    $fecha_nacError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['sex']->render(array('class' => $sexError)) ?></td>
                                <td><?php echo $form['fecha_nac']->render(array('class' => $fecha_nacError)) ?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><?php echo $form['formacion_academica_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $form['formacion_academica_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <?php
                                $formacion_academica_idError = '';
                                if ($form['formacion_academica_id']->hasError()) {
                                    $formacion_academica_idError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['formacion_academica_id']->render(array('class' => 'fomacion_academica ' . $formacion_academica_idError)) ?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><?php echo $form['colaborador_nivel_uno_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $form['colaborador_nivel_uno_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <?php
                                $colaborador_nivel_uno_idError = '';
                                if ($form['colaborador_nivel_uno_id']->hasError()) {
                                    $colaborador_nivel_uno_idError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['colaborador_nivel_uno_id']->render(array('class' => $colaborador_nivel_uno_idError)) ?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><?php echo $form['colaborador_nivel_dos_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $form['colaborador_nivel_dos_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <?php
                                $colaborador_nivel_dos_idError = '';
                                if ($form['colaborador_nivel_dos_id']->hasError()) {
                                    $colaborador_nivel_dos_idError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['colaborador_nivel_dos_id']->render(array('class' => 'fomacion_academica ' . $colaborador_nivel_dos_idError)) ?></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td width="80"></td>
                                <td width="85"><?php echo $form['cp']->renderError() ?></td>
                                <td width="106"></td>
                                <td width="56"><?php echo $form['road_type_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $form['cp']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <?php
                                $cpError = '';
                                if ($form['cp']->hasError()) {
                                    $cpError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['cp']->render(array('class' => 'tamano_6_c ' . $cpError)) ?></td>
                                <th><?php echo $form['road_type_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <?php
                                $road_type_idError = '';
                                if ($form['road_type_id']->hasError()) {
                                    $road_type_idError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['road_type_id']->render(array('class' => 'select_pequeño ' . $road_type_idError)) ?></td>
                            </tr>
                        </table>
                        <table  width="295" height="40" border="0" align="left">
                            <tr>
                                <th width="43" align="left"><?php echo $form['direccion']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th width="89"><?php echo $form['numero']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th width="66"><?php echo $form['piso']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th width="67"><?php echo $form['puerta']->renderLabel(null, array('class' => 'bundle')) ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $form['direccion']->renderError() ?></td>
                                <td><?php echo $form['numero']->renderError() ?></td>
                                <td><?php echo $form['piso']->renderError() ?></td>
                                <td><?php echo $form['puerta']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php
                                $direccionError = '';
                                if ($form['direccion']->hasError()) {
                                    $direccionError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $numeroError = '';
                                if ($form['numero']->hasError()) {
                                    $numeroError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $pisoError = '';
                                if ($form['piso']->hasError()) {
                                    $pisoError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $puertaError = '';
                                if ($form['puerta']->hasError()) {
                                    $puertaError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['direccion']->render(array('class' => 'tamano_32_c ' . $direccionError)) ?></td>
                                <td><?php echo $form['numero']->render(array('class' => 'tamano_4_c ' . $numeroError)) ?></td>
                                <td><?php echo $form['piso']->render(array('class' => 'tamano_4_c ' . $pisoError)) ?></td>
                                <td><?php echo $form['puerta']->render(array('class' => 'tamano_4_c ' . $puertaError)) ?></td>
                            </tr>
                        </table>
                        <table width="458" border="0">
                            <tr>
                                <th><?php echo $form['states_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $form['city_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $form['states_id']->renderError() ?></td>
                                <td><?php echo $form['city_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php
                                $states_idError = '';
                                if ($form['states_id']->hasError()) {
                                    $states_idError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $city_idError = '';
                                if ($form['city_id']->hasError()) {
                                    $city_idError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $form['states_id']->render(array('class' => $states_idError)); ?></td>
                                <td><?php echo $form['city_id']->render(array('class' => 'select_mediano ' . $city_idError)) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
            <div><a name="mid" id="mid"></a></div>
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <h2>MÉTODO DE COBRO DE RECOMPENSAS</h2>
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
                                <tr align="left">
                                    <th colspan="2"><?php echo $form['metodo_cobro_id']->renderLabel() ?></th>
                                </tr>
                                <tr align="left">
                                    <td>
                                        <?php echo $form['metodo_cobro_id']->renderError() ?> <?php echo $form['metodo_cobro_id'] ?>
                                        <div id="Preload" class="preload" style="display:none"><?php echo image_tag('/images/preloader-mini.gif') ?></div>
                                        <div id="Ok" class="preload" style="display:none"><?php echo image_tag('/images/ok_icon_20.png') ?></div>
                                        <div id="Error" class="preload" style="display:none"><?php echo image_tag('/images/error_icon_20.png') ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div id="Metodo_form" style=""></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <?php echo link_to(__('Deseo ser informado cada vez que...'), "popup/deseoserinformadocadavezque", array('style' => 'font-size:18px', "popup" => array("popWindow", "width=650,height=500, left=200"))) ?>
                        <div style="float: right; cursor: pointer;">
                            <?php echo image_tag('arrow_down.png', array('onclick' => '$("#detailBox").slideToggle("slow");')); ?>
                        </div>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
            <div class="border-box" id="detailBox" style="display: none;">
                <div class="top-left">
                    <div class="top-right">
                        <table>
                            <tbody>
                                <!-- COLABORADOR CONTRIBUYE  -->
                                <tr>
                                    <td><?php echo $form['notification']['colaborador_contribuye_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['colaborador_contribuye_value']->render() ?>
                                        <?php echo $form['notification']['colaborador_contribuye_value']->renderLabel() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <!-- CONCURSO ENTIDAD  -->
                                <tr>
                                    <td><?php echo $form['notification']['concurso_empresa_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['concurso_empresa_value']->render() ?>
                                        <?php echo $form['notification']['concurso_empresa_value']->renderLabel() ?>
                                        <?php echo $form['notification']['concurso_empresa_nombre']->render() ?>&nbsp;<?php echo __('en') ?>&nbsp;
                                        <?php echo $form['notification']['concurso_empresa_provincia_id']->render() ?>&nbsp;<?php echo __('en la localidad de') ?>&nbsp;
                                        <?php echo $form['notification']['concurso_empresa_ciudad_id']->render() ?>
                                    </td>
                                </tr>
                                <!-- CONCURSO PRODUCTO  -->
                                <tr>
                                    <td><?php echo $form['notification']['concurso_producto_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['concurso_producto_value']->render() ?>
                                        <?php echo $form['notification']['concurso_producto_value']->renderLabel() ?>
                                        <?php echo $form['notification']['concurso_producto_nombre']->render() ?> de la marca <?php echo $form['notification']['concurso_producto_marca']->render() ?>
                                    </td>
                                </tr>
                                <!-- LISTA BLANCA  -->
                                <tr>
                                    <td><?php echo $form['notification']['lista_blanca_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['lista_blanca_value']->render() ?>
                                        <?php echo $form['notification']['lista_blanca_value']->renderLabel() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <!-- LISTA NEGRA  -->
                                <tr>
                                    <td><?php echo $form['notification']['lista_negra_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['lista_negra_value']->render() ?>
                                        <?php echo $form['notification']['lista_negra_value']->renderLabel() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <!-- LISTA NEGRA  -->
                                <tr>
                                    <td><?php echo $form['notification']['publica_profesional_value']->renderError() ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form['notification']['publica_profesional_value']->render() ?>
                                        <?php echo $form['notification']['publica_profesional_value']->renderLabel() ?>
                                    </td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
            <!----------------------->
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <table>
                            <tr>



                                <td>   <div style="float: left"><?php echo link_to('vuelve a auditoscopia', '@homepage') ?></div>
                                </td>
                                <td colspan="2" style="text-align: center"><br /> <?php echo $form->renderHiddenFields() ?>
                                    <input type="hidden" name="metodo_guardado" value="">
                                    <input id="micuenta_Confirma_button" type="button" value="<?php echo __('confirma datos') ?>"/>
                                    <br/></td>
                                <td>    <div style="float:right"><?php echo link_to(__('darme de baja'), 'vosotros/baja_colaborador') ?></div></td>

                            </tr>
                        </table>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>



        </form>
    </div>

    <div style="display: none">
        <div id="Not_metodo_dialog">
            <div class="border-box-n">
                <div class="header-left"><div class="header-right"></div></div>
                <div class="top-left">
                    <div class="top-right">

                        <p>Necesitas <strong>rellenar tu método de cobro de recompensas</strong> para hacer caja.</p>
                        <p>Gracias por tu colaboración.</p>

                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none">
        <div id="Contraseña_cambiada_dialog">
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <p>Has cambiado tu contraseña correctamente.</p>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- el lightbox para avisar al usuario - concurso-->
<div style="display: none">
    <div id="caja_dialog_box">
        <section class="border-box-n " >
            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right">
                    <?php if ($error || $caja_error): ?>
                        <?php if ($error): ?>
                            <p>Has intentado hacer caja <strong>sin tener la cantidad mínima necesaria</strong>. </p>
                            <p>Para hacer caja <strong>necesitas tener al menos 30&nbsp;€</strong> en tu cuenta.</p>
                            <p>Muchas gracias por tu comprensión.</p>
                        <?php else: ?>

                            <p>
                                Has solicitado hacer caja <strong>sin indicar correctamente un método de cobro</strong> de recompensas.
                            </p>
                            <p>
                                Por favor, indica un método de cobro de recompensas válido en <strong>Mi cuenta</strong> – <strong>Método de cobro de recompensas.</strong>
                            </p>
                            <p>
                                Gracias por tu colaboración.
                            </p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>
                            Has solicitado <strong>hacer caja correctamente</strong>.
                        </p>
                        <p>
                            Tienes en tu caja la cantidad de <b><?php echo $sf_user->getMoneyInFormat($money); ?>&nbsp;€</b>.
                        </p>
                        <p>
                            ¿Estás seguro de que quieres hacer caja en este momento?
                        </p>
                        <p>Una vez aceptada, esta acción no podrá deshacerse.</p>
                        <p class="align-right">
                            <a href="#" id="caja" title="acepta">acepta</a> | <a href="javascript:void(0)" onclick="$.fancybox.close()" title="cancela">cancela</a>
                        </p>
                    <?php endif; ?>

                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </section>
    </div>

</div>
<!-- user confirmation caja message -->
<div class="hidden" id="user_caja_messagebox">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" id="user_message_content">
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#user_caja_messagebox" class="hidden" id="user_message_ancor">message box</a>
<div id="money-error-box" class="hidden">

    <p>Necesitas <strong>rellenar tu método de cobro de recompensas</strong> para hacer caja.</p>
    <p>Gracias por tu colaboración.</p>

</div>
<div id="is_caja" class="hidden">
    <p>Has <strong>hecho caja</strong> correctamente.</p>
    <p>En breve recibirás la cantidad de <b><?php echo $sf_user->getMoneyInFormat($caja_amount) ?></b>&nbsp;€ en tu cuenta.</p>
    <p>¡Disfruta de tu recompensa!</p>
</div>
<div class="hidden" id="caja_banco_message">
    <p>
        Has solicitado hacer caja <strong>sin indicar correctamente un método de cobro</strong> de recompensas.
    </p>
    <p>
        Por favor, indica un método de cobro de recompensas válido en <strong>Mi cuenta</strong> – <strong>Método de cobro de recompensas.</strong>
    </p>
    <p>
        Gracias por tu colaboración.
    </p>
</div>
<script type="text/javascript">
                            $(document).ready(function() {
                                $("#micuenta_Confirma_button").live('click', function() {
                                    if ($('#sfApplyPerfil_metodo_cobro_id').val() == 1) {
                                        $.ajax({
                                            url: '<?php echo url_for('/vosotros/updatesettings'); ?>',
                                            data: $("#formulario").serialize(),
                                            type: 'POST',
                                            success: function(data) {
                                                $('#formulario').submit();
                                            }
                                        });
                                        return false;

                                    } else {
                                        $.ajax({
                                            url: '<?php echo url_for('vosotros'); ?>',
                                            type: 'POST',
                                            success: function(data) {
                                                //$('input[name=micuenta_ajax_submit]').trigger('click');
                                                $('#formulario').submit();
                                            }
                                        });
                                    }
                                });

                                $("#formulario").submit(function() {
                                    if ($('#sfApplyPerfil_metodo_cobro_id').val() != 1) {
                                        if ($('#Guardar').val() != 'true') {
                                            $.fancybox({content: $('#Not_metodo_dialog'), padding: 5});
                                            return false;
                                        }
                                    }

                                    return true;
                                });

                                var show_change_password = false;
                                var change_password = function() {
                                    if (!show_change_password) {
                                        $('#ChangePass_form').load('<?php echo url_for('change_pass/index') ?>', function() {
                                            show_change_password = true;
                                        });
                                        $('#ChangePass_form').show();
                                    }
                                    else {
                                        show_change_password = false;
                                    }
                                };

                                $('#sfApplyPerfil_metodo_cobro_id').change(function() {
                                    if ($('#sfApplyPerfil_metodo_cobro_id').val() == 2)
                                    {
                                        $("#Ok").hide();
                                        $('#Preload').show();
                                        $('#Preload').css('display', 'inline');
                                        $('#Metodo_form').load('<?php echo url_for('metodo_banco/edit?id=' . $sf_user->getGuardUser()->getId()) ?>', function() {
                                            $('#Preload').hide();
                                            $('#Ok').show();
                                            $('#Ok').css('display', 'inline');
                                        });
                                    }
                                    else if ($('#sfApplyPerfil_metodo_cobro_id').val() == 3)
                                    {
                                        $("#Ok").hide();
                                        $('#Preload').show();
                                        $('#Preload').css('display', 'inline');
                                        $('#Metodo_form').load('<?php echo url_for('metodo_paypal/edit?id=' . $sf_user->getGuardUser()->getId()) ?>', function() {
                                            $('#Preload').hide();
                                            $('#Ok').show();
                                            $('#Ok').css('display', 'inline');
                                        });
                                    }
                                    else if ($(this).val() == 1)
                                    {
                                        $('#Metodo_form').html('');
                                        $('#Metodo_form').html('');
                                        $('#Preload').hide();
                                        $('#Ok').hide();
                                        $('#Preload').hide();
                                        $('#Error').hide();
                                    }
                                });

                                /* Estudiante, ama de casa, parado, otro */
                                if (
                                        ($('#sfApplyPerfil_colaborador_nivel_uno_id').val() == 25) ||
                                        ($('#sfApplyPerfil_colaborador_nivel_uno_id').val() == 24) ||
                                        ($('#sfApplyPerfil_colaborador_nivel_uno_id').val() == 23) ||
                                        ($('#sfApplyPerfil_colaborador_nivel_uno_id').val() == 22))
                                    $('#sfApplyPerfil_colaborador_nivel_dos_id').attr("disabled", true);
                                else
                                    $('#sfApplyPerfil_colaborador_nivel_dos_id').attr("disabled", false);

                                /*if (($("#sfApplyPerfil_city_id").val()==5884) || ($("#sfApplyPerfil_city_id").val()==5885))
                                 $("#sfApplyPerfil_city_id").attr("disabled","disabled");*/


                                if (($("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").val() == 5884) ||
                                        ($("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").val() == 5885) ||
                                        ($("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").val() == 8113))
                                    $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").attr("disabled", "disabled");

                                $("#sfApplyPerfil_states_id").change(function() {
                                    /*if($(this).val()==16){    //ceuta
                                     setTimeout(function() {
                                     $("#sfApplyPerfil_city_id option[value=5884]").attr("selected",true); //ceuta
                                     $("#sfApplyPerfil_city_id").attr("disabled","disabled");
                                     }, 50);
                                     }
                                     else if($(this).val()==35){   //melilla
                                     setTimeout(function() {
                                     $("#sfApplyPerfil_city_id option[value=5885]").attr("selected",true); //  melilla
                                     $("#sfApplyPerfil_city_id").attr("disabled","disabled");
                                     }, 50);
                                     }*/
                                    //ceuta_melilla($("#sfApplyPerfil_states_id"),$("#sfApplyPerfil_city_id"));
                                });
                                $("#sfApplyPerfil_notification_concurso_empresa_provincia_id").change(function() {
                                    if ($(this).val() == 1) { //Todas
                                        setTimeout(function() {
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id option[value=8113]").attr("selected", true); //todas
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                                        }, 50);
                                    }
                                    else if ($(this).val() == 16) {   //ceuta
                                        setTimeout(function() {
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id option[value=5884]").attr("selected", true); //ceuta
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                                        }, 50);
                                    }
                                    else if ($(this).val() == 35) {   //melilla
                                        setTimeout(function() {
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id option[value=5885]").attr("selected", true); //  melilla
                                            $("#sfApplyPerfil_notification_concurso_empresa_ciudad_id").attr("disabled", "disabled");
                                        }, 50);
                                    }
                                });


                                if ($('#sfApplyPerfil_metodo_cobro_id').val() == 2)
                                {
                                    $('#Metodo_form').load('<?php echo url_for('metodo_banco/edit?id=' . $sf_user->getGuardUser()->getId()) ?>', function() {
                                        $('#Preload').hide();
                                        $('#Ok').show();
                                        $('#Ok').css('display', 'inline');
                                    });
                                }
                                else if ($('#sfApplyPerfil_metodo_cobro_id').val() == 3)
                                {
                                    $('#Metodo_form').load('<?php echo url_for('metodo_paypal/edit?id=' . $sf_user->getGuardUser()->getId()) ?>', function() {
                                        $('#Preload').hide();
                                        $('#Ok').show();
                                        $('#Ok').css('display', 'inline');
                                    });
                                }

                                $('#sfApplyPerfil_colaborador_nivel_uno_id').change(function() {
                                    if (($(this).val() == 25) || ($(this).val() == 24) || ($(this).val() == 23) || ($(this).val() == 22))
                                        $('#sfApplyPerfil_colaborador_nivel_dos_id').attr("disabled", true);
                                    else
                                        $('#sfApplyPerfil_colaborador_nivel_dos_id').attr("disabled", false);
                                });

                                $("#sfApplyPerfil_notification_concurso_producto_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca') ?>", {
                                    width: 260,
                                    selectFirst: false
                                });
                                $("#sfApplyPerfil_notification_concurso_producto_nombre").autocomplete("<?php echo url_for('ajax_get/productos_by_nombre') ?>", {
                                    width: 260,
                                    selectFirst: false
                                });
                                $("#sfApplyPerfil_notification_concurso_empresa_nombre").autocomplete("<?php echo url_for('ajax_get/empresas_by_nombre') ?>", {
                                    width: 260,
                                    selectFirst: false
                                });

                                $("#caja_box").fancybox({padding: 5});
                                $("#user_message_ancor").fancybox({padding: 5});

                                $("#caja_button").bind('click', function() {
                                    var banco_val = $('#sfApplyPerfil_metodo_cobro_id').val();
                                    if ((banco_val != 1 && $('#Guardar').val() != 'true') || banco_val == 1) {
                                        showUserMessageBox($('#caja_banco_message').html());
                                    } else {
                                        $("#caja_box").trigger('click');
                                    }
                                });

<?php if ($sf_user->hasFlash('cajaInfo')) : ?>
                                    $.fancybox('<?php echo $sf_user->getFlash('cajaInfo', ESC_RAW) ?>',
                                            {
                                                'autoDimensions': false,
                                                'width': 350,
                                                'height': 'auto',
                                                'transitionIn': 'none',
                                                'transitionOut': 'none'
                                            });
<?php endif; ?>
                                $('#is_caja_anchor').fancybox({padding: 5});
                                if (<?php echo $is_caja ? 1 : 0 ?>) {
                                    showUserMessageBox($('#is_caja').html());

                                }
                                // exeucte caja accept event
                                $("#caja").bind('click', function() {

                                    $.ajax({
                                        url: '/vosotros/caja',
                                        type: 'POST',
                                        success: function(data) {
                                            window.location = '<?php echo url_for('vosotros') ?>/caja/true/caja_amount/' + data;
                                            // if success then show user a message
                                            /*    $('#warning-message').addClass('hidden');
                                             $('#confirmation-message').removeClass('hidden');
                                             $('#cashup-log').html(data);
                                             showUserMessageBox($('#money-error-box').html());*/

                                        }
                                    });
                                });
                                //end caja accept event

                                //if user has more then 30 euro and have not fill the payent method
                                if (!<?php echo $user_profile->getMetodoCobroId() - 1 ?> && <?php echo $user_profile->getMoney() ?> >= 30 && <?php echo $form->hasErrors() ? '0' : '1'; ?>) {
                                    showUserMessageBox($('#money-error-box').html());
                                }

                                // issu in this line
                                // ceuta_melilla($("#sfApplyPerfil_states_id"),$("#sfApplyPerfil_city_id"));




                            });
                            function showUserMessageBox(message) {
                                $.fancybox.close();
                                $("#user_message_content").html(message);
                                $("#user_message_ancor").trigger('click');
                            }
</script>

<script type="text/javascript">

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
    ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $(document).ready(function() {

        $("#sfApplyPerfil_states_id").change(function() {
            ceuta_melilla($(this), $("#sfApplyPerfil_city_id"))
        });
        $("form").bind("submit", function() {
            $("#sfApplyPerfil_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#sfApplyPerfil_states_id"), $("#sfApplyPerfil_city_id"));


    });
</script>
<style type="text/css">
    select.errorInviteFrm,
    input.errorInviteFrm{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>