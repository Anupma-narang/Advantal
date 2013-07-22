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
<div class="border-box">
    <div class="top-left">
        <div class="top-right">
            <table>
                <tbody>
                    <tr>
                        <td width="232"></td>
                        <td width="255"></td>
                        <td width="303"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><?php echo $form->renderGlobalErrors() ?></td>
                    </tr>

                    <!-- EMAIL -->
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['email']->getError()): ?>
                                <ul class="error_list barra_corta">
                                    <li><?php echo $form['email']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        $emailError = '';
                        if ($form['email']->hasError()) {
                            $emailError = 'error';
                        }
                        ?>
                        <td><?php echo $form['email']->renderLabel(null, array('class' => 'bundle required')) ?>
                        </td>
                        <td><?php echo $form['email']->render(array('class' => 'tamano_32_c ' . $emailError)) ?></td>
                        <td></td>
                    </tr>
                    <!-- REPEAT EMAIL -->
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['email2']->getError()): ?>
                                <ul class="error_list barra_corta">
                                    <li><?php echo $form['email2']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        $emailTwoError = '';
                        if ($form['email2']->hasError()) {
                            $emailTwoError = 'error';
                        }
                        ?>
                        <td><?php echo $form['email2']->renderLabel(null, array('class' => 'bundle')) ?>
                        </td>
                        <td><?php echo $form['email2']->render(array('class' => 'tamano_32_c ' . $emailTwoError)) ?></td>
                        <td></td>
                    </tr>
                    <!-- USERNAME -->
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['username']->getError()): ?>
                                <ul class="error_list barra_corta">
                                    <li><?php echo $form['username']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        $userError = '';
                        if ($form['username']->hasError()) {
                            $userError = 'error';
                        }
                        ?>
                        <td><?php echo $form['username']->renderLabel(null, array('class' => 'bundle')) ?>
                        </td>
                        <td><?php echo $form['username']->render(array('class' => 't_f_c ' . $userError)) ?></td>
                        <td><?php echo link_to(__('Consejos para crear una cuenta'), "popup/consejosparacrearunacuenta", array("popup" => array("popWindow", "width=650,height=500, left=200"))) ?>
                        </td>
                    </tr>
                    <!-- PASSWORD -->
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['password']->getError()): ?>
                                <ul class="error_list barra_corta">
                                    <li><?php echo $form['password']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        $passwordError = '';
                        if ($form['password']->hasError()) {
                            $passwordError = 'error';
                        }
                        ?>
                        <td><?php echo $form['password']->renderLabel(null, array('class' => 'bundle')) ?>
                        </td>
                        <td><?php echo $form['password']->render(array('class' => 'tamano_16_c ' . $passwordError)) ?><div id="result" style="color: green;display: inline-block; margin: -4px 0;"></div></td>
                        <td><?php echo link_to(__('Consejos para crear una contraseña'), "popup/consejosparacrearunapass", array("popup" => array("popWindow", "width=650,height=500, left=200"))) ?>
                        </td>
                    </tr>
                    <!-- REPEAT PASSWORD -->
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['password2']->getError()): ?>
                                <ul class="error_list barra_corta">
                                    <li><?php echo $form['password2']->getError() ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        $passwordTwoError = '';
                        if ($form['password2']->hasError()) {
                            $passwordTwoError = 'error';
                        }
                        ?>
                        <td><?php echo $form['password2']->renderLabel(null, array('class' => 'bundle')) ?></td>
                        <td><?php echo $form['password2']->render(array('class' => 'tamano_16_c ' . $passwordTwoError)) ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php if ($form['image']->getError()): ?><ul class="error_list barra_corta"><li><?php echo $form['image']->getError() ?></li></ul><?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;"><?php echo $form['image']->renderLabel(null, array('class' => 'bundle')) ?></td>
                        <td colspan="2" style="vertical-align:top;" class="thumbnail"><?php echo $form['image']->render() ?>
                           <!-- <img style="margin-left: 148px;vertical-align: top;" src=""/> -->
                            <!-- /images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_users_dir')) . '/' .(!$this->getObject()->getImage()?'default.png':$this->getObject()->getImage())
                            <?php //echo "images/".basename(sfConfig::get('sf_upload_dir')) . '"/" '. basename(sfConfig::get('sf_users_dir') ?> </td>
                            -->
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <?php if ($form['captcha']->getError()): ?><ul class="error_list barra_corta"><li><?php echo $form['captcha']->getError() ?></li></ul><?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><div class="captcha"><?php echo $form['captcha']->render(array('class' => 'error')) ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center"><br />
                            <div style="width: 180px; margin:auto;">
                                <input type="submit" id="nextStep" value="<?php echo __('siguiente') ?>" class="red_button" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <br/><br/>
                            <strong><?php echo __('* Datos requeridos') ?></strong>
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
    input.error{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    input.t_f_c{
        width: 202px;
        font-size: 15px;
    }
    form#sf_apply_apply_form input {
        font-size: 15px;
    }
</style>
<script type="text/javascript">
    $("input#sfApplyForm1_image_newfile").filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
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

        $('#sfApplyForm1_password').keyup(function() {
            $('#result').html(passwordStrength($('#sfApplyForm1_password').val(), $('#sfApplyForm1_username').val()));
        });
<?php if (isset($thumbnail)): ?>
            if ($('td.thumbnail img').length > 0)
                $('td.thumbnail img').attr('src', '<?php echo image_path('uploads/users/' . $thumbnail); ?>')
<?php endif; ?>
    });
</script>