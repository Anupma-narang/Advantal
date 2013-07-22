<?php use_helper('I18N') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
    <div id="content_breadcroum">
    <?php echo link_to("inicio","home/index") ?> >> <span style="font-weight:bold;">Entra en auditoscopia</span>
</div>
 
<div id="table_login">
  <div class="form_login">
       <div class="h2_title">
            <?php echo __('Entra en <span class="nosotros_auditoscopia_subtitle">audit<span class="auditoscopia_o_subtitle">o</span>scopia</span>') ?>
        </div>

        <form method="POST"
              action="<?php echo url_for("@sf_guard_signin") . (!empty($redirect_url)?'?redirect='.$redirect_url:'') ?>" name="sf_guard_signin" id="sf_guard_signin" class="sf_apply_signin_inline">

        <?php echo $form->renderHiddenFields() ?>
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <table border="0" width="600">
                            <tbody>
                                <!-- EMAIL -->
                                <tr class="">
                                    <td colspan="2"><?php echo $form['username']->renderError() ?></td>
                                </tr>
                                <tr class="tr_alto_user">
                                    <td><label class="bundle"> <?php echo __('Correo electrónico') ?></label>
                                    </td>
                                    <td><?php echo $form['username']->render()?></td>

                                </tr>
                                <tr class="">
                                    <td colspan="2"><?php echo $form['password']->renderError() ?></td>
                                    <td></td>
                                </tr>
                                <tr class="tr_alto_user">
                                    <td><label class="bundle"> <?php echo __('Contraseña') ?></label>
                                    </td>

                                    <td><?php echo $form['password']->render() ?></td>

                                </tr>
<!--                                 <tr>
                                    <td><br/></td>
                                    <td></td>

                                </tr>-->

                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td><span class="link_rojo"><?php echo link_to(__('¿Has olvidado tu contraseña?'), 'sfApply/resetRequest',array("title" => "¿Has olvidado tu contraseña?")) ?> </span></td>

                                </tr>
                              <tr class="tr_alto_user">
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr class="tr_alto_user">

                                    <td colspan="2" align="center">

                                    <input type="submit" value="<?php echo __('entra') ?>" class="gray_button_150" title="Entra en tu cuenta de auditoscopia" />

                                    </td>

                                </tr>
<!--                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>-->
                                <tr class="tr_alto_user">
                                    <td></td>
                                    <td><?php echo $form["remember"] ?>Recuerda mis datos</td>
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
                                <div id="haztecolaborador_login"> ¿Aún no eres colaborador? <strong>¡Crea una cuenta ahora!</strong></div>


                            </td>
                            <td></td>
                        </tr>
                        <tr class="tr_alto_user">
                            <td></td>
                            <td align="center">
<!--                                <div class="resaltar" style="width: 180px; margin:auto;">     -->
                                    <?php echo button_to('crea una cuenta', 'sfApply/apply', array("class" => "red_button", "title" => "Crea una cuenta en auditoscopia")) ?>
<!--                            </div>-->
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
