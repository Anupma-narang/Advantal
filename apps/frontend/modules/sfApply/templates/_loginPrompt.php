<?php use_helper('I18N') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
    <div id="content_breadcroum">
    <?php echo link_to("inicio","home/index") ?> >> Colaborador
</div> 

<div id="table_login">
   <div class="form_login">
        <div class="h2_title">
            <?php echo __('Entra en <span class="nosotros_auditoscopia_subtitle">audit<span class="auditoscopia_o_subtitle">o</span>scopia</span>') ?>
        </div>

        <form method="POST" action="<?php echo url_for("@sf_guard_signin") ?>" name="sf_guard_signin" id="sf_guard_signin" class="sf_apply_signin_inline">

            <?php echo $form->renderHiddenFields() ?>
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <table border="0" width="600">
                            <tbody>
                                <!-- EMAIL -->
                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td><?php echo $form['username']->renderError() ?></td>
<!--                                    <td></td>-->
                                </tr>
                                <tr class="tr_alto_user">
                                    <td><label class="bundle"> <?php echo __('Correo electrónico') ?></label>
                                        <?php //echo $form['username']->renderLabel(null, array('class' => 'bundle required'))?>
                                    </td>
                                    <td><?php echo $form['username']->render() ?></td>
<!--                                    <td></td>-->
                                </tr>
                             
                                <tr>
                                    <td><label> <?php echo __('Password') ?></label>
                                        <?php //echo $form['password']->renderLabel(null, array('class' => 'bundle required'))?>
                                    </td>
                                    <td><?php echo $form['password']->render() ?></td>
<!--                                    <td></td>-->
                                </tr>
<!--                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>-->
                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td><span class="link_rojo"><?php echo link_to(__('¿Has olvidado tu contraseña?'), 'sfApply/resetRequest') ?> </span></td>
<!--                                    <td></td>-->
                                </tr>
                                        <tr class="tr_alto_user">
                                    <td></td>
                                    <td></td>
<!--                                    <td></td>-->
                                </tr>
                                <tr class="tr_alto_user">
<!--                                    <td></td>-->
                                    <td colspan="2" align="center">
                                        <input type="submit" value="<?php echo __('entra') ?>" class="gray_button_150" />
<!--                                    <div id="boton_entra"><?php //echo link_to (__("entra"), "login/index")?> </div>-->
                                    </td>
<!--                                    <td></td>-->
                                </tr>
                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td><?php echo $form["remember"] ?>Recuerda mis datos</td>
<!--                                    <td></td>-->
                                </tr>
                            </tbody>
                        </table>



                    </div>
                    <div class="bottom-left">
                        <div class="bottom-right"></div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <br/>
    
    <div class="border-box">
        <div class="top-left">
            <div class="top-right">


                <table border="0" align="center" width="500">
                    <tbody>
                        <!-- EMAIL -->
                        <tr class="tr_alto_user">
                            <td></td>
                            <td align="center">
                                <div id="haztecolaborador_login"> ¿Aún no eres colaborador? <span class="subtitulo_haztecolaborador_login"<strong>¡Crea una cuenta ahora!</strong></span></div>
                                </td>
                            <td></td>
                        </tr>

                        <tr class="tr_alto_user">
                            <td></td>
                            <td align="center">
<!--                                <div class="resaltar" style="width: 180px; margin:auto;">-->
                                    <?php echo button_to('crea una cuenta', 'sfApply/apply', array("class" => "red_button")) ?>
<!--                                </div>-->
                                </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <div class=clear></div>


            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>












</div>