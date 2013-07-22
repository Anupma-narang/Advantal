<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('forms.css') ?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div id="content_breadcroum">
    <?php echo link_to("inicio", "home/index") ?> >> <span style="font-weight: bold;">Cambia tu contraseña</span>
</div>
<div style="clear:both"></div>
<div class="sf_apply sf_apply_reset_request">
    <div class="border-box">
        <div class="top-left">
            <div class="top-right">
                <form method="POST"
                      action="<?php echo url_for('sfApply/resetRequest') ?>"
                      name="sf_apply_reset_request" id="sf_apply_reset_request">
                    <p style="text-align: justify;">
                        <?php
                        echo __(<<<EOM

¿Has olvidado tu contraseña? ¡No pasa nada! Introduce tu correo electrónico  y haz clic en “cambia tu contraseña”. Recibirás un mensaje en tu cuenta de correo con instrucciones sobre cómo conseguir una nueva contraseña y volver a entrar en <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.
EOM
                        )
                        ?>
                    </p>


                    <table><tbody>
                            <tr>
                                <td>
                                    <?php if ($sf_user->hasFlash('error_form')): ?>
                                        <ul class="flash_error_list">
                                            <li style="font-weight: bold">
                                                <?php echo $sf_user->getFlash('error_form', ESC_RAW) ?>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo 'Introduce tu correo electrónico'//$form['username_or_email']->renderLabel()        ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo $form['username_or_email']->renderError() ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form['username_or_email']->render() ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->renderHiddenFields() ?></td>
                            </tr>
                        </tbody></table>
                    <p>
                        <input type="submit" value="<?php echo __("cambia tu contraseña") ?>" title="Cambia tu contraseña de entrada en auditoscopia">
                        <?php echo link_to_function('cancela', 'history.go(-1)', array("title" => "Cancela cambio de contraseña")) ?>
                    </p>
                </form>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<style type="text/css">
    ul.flash_error_list li{
        background-position: 4px 5px !important;
        font-size: 15px !important;
        margin-top: 0px !important;
    }

</style>