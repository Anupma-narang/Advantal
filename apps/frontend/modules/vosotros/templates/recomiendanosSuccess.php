<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>
<?php use_helper("I18N", "jQuery") ?>

<?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Recomiéndanos a un amigo', 'tituloSeccion' => 'Recomiéndanos a un amigo')) ?>

<h1><?php echo __('Recomiéndanos a un amigo') ?></h1>
<div id="content_concursos_nuevo">
    <?php if ($sf_user->hasFlash('errorInvite')): ?>
        <ul class="error_list">
            <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorInvite', ESC_RAW) ?></li>
        </ul>
    <?php endif; ?>
    <div class="border-box">
        <div class="header-left">
            <div class="header-right">
            </div>
        </div>
        <div class="top-left">
            <div class="top-right">
                <div class="static-box">
                    <p>Queremos <strong>agradecerte sinceramente por recomendarnos</strong> a un amigo:</p>
                    <ul class="bundle">

                        <li>Con tu recomendación, <strong>ayudas a tu amigo a mejorar sus productos y servicios favoritos</strong> y ganar regalos y dinero.</li>
                        <li>También nos <strong>ayudas a nosotros a ayudar a tu amigo</strong> y a otros muchos amigos a disfrutar de una experiencia de cliente satisfactoria y memorable.</li>
                        <li>Contribuyes a que nuestra <strong>comunidad sea más grande e influyente</strong>.</li>
                        <li>Y además, por cada amigo que recomiendas y se convierte en colaborador de la comunidad, <strong>te recompensamos con 50 puntos</strong>. </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
    <div style="clear: both"></div>

    <form action="<?php echo url_for('vosotros/recomiendanos'); ?>" method="post" <?php $recomienda->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">
                    <table width="100%">
                        <tr>
                            <td colspan="2"><?php echo $recomienda['nombre']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $recomienda['nombre']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <?php
                            $nomError = '';
                            if ($recomienda['nombre']->hasError()) {
                                $nomError = 'errorInviteFrm';
                            }
                            ?>
                            <td ><?php echo $recomienda['nombre']->render(array('class' => 'tamano_32_c ' . $nomError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $recomienda['apellido1']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $recomienda['apellido1']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <?php
                            $apellido1Error = '';
                            if ($recomienda['apellido1']->hasError()) {
                                $apellido1Error = 'errorInviteFrm';
                            }
                            ?>
                            <td ><?php echo $recomienda['apellido1']->render(array('class' => 'tamano_32_c ' . ($sf_user->isAuthenticated() ? ' cgr1-color ' : '') . $apellido1Error)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $recomienda['apellido2']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $recomienda['apellido2']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <?php
                            $apellido2Error = '';
                            if ($recomienda['apellido2']->hasError()) {
                                $apellido2Error = 'errorInviteFrm';
                            }
                            ?>
                            <td ><?php echo $recomienda['apellido2']->render(array('class' => 'tamano_32_c ' . ($sf_user->isAuthenticated() ? ' cgr1-color ' : '') . $apellido2Error)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $recomienda['email']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $recomienda['email']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <?php
                            $emailError = '';
                            if ($recomienda['email']->hasError()) {
                                $emailError = 'errorInviteFrm';
                            }
                            ?>
                            <td ><?php echo $recomienda['email']->render(array('class' => 'tamano_32_c ' . ($sf_user->isAuthenticated() ? ' cgr1-color ' : '') . $emailError)) ?></td>
                        </tr>


                    </table>
                    <?php echo $recomienda->renderHiddenFields(); ?>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">
                <div class="header-right"></div>
            </div>
            <div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both"><?php echo __('TUS AMIGOS'); ?></h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">
                    <table>
                        <?php $pos = 1; ?>
                        <?php while ($pos != 11): ?>
                            <tr>
                                <td><label for="recomienda_name" class="bundle"><?php echo __('Nombre de amigo ') . $pos . ($pos == 1 ? '*' : '') ?></label></td>
                                <td><label for="recomienda_emails" class="bundle"><?php echo __('Su correo electrónico ') . ($pos == 1 ? '*' : '') ?></label></td>
                            </tr>
                            <tr>
                                <td><?php echo $recomienda['user_name_' . $pos]->renderError() ?></td>
                                <td><?php echo $recomienda['user_email_' . $pos]->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php
                                $user_nameError = '';
                                if ($recomienda['user_name_' . $pos]->hasError()) {
                                    $user_nameError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $user_emailError = '';
                                if ($recomienda['user_email_' . $pos]->hasError()) {
                                    $user_emailError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $recomienda['user_name_' . $pos]->render(array('class' => 'tamano_32_c ' . $user_nameError)) ?></td>
                                <td><?php echo $recomienda['user_email_' . $pos]->render(array('class' => 'tamano_32_c ' . $user_emailError)) ?></td>
                            </tr>

                            <?php $pos = $pos + 1; ?>
                        <?php endwhile; ?>

                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">
                <div class="header-right"></div>
            </div>
            <div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both"><?php echo __('TU MENSAJE'); ?></h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left">
                <div class="header-right"></div>
            </div>
            <div class="top-left">
                <div class="top-right">
                    <table width="100%" >
                        <tr>
                            <td >
                                <!--ul class="error_list" id="max_length_error" style="display: none;">
                                    <li>Has superado el espacio permitido para tu mensaje.</li>
                                </ul-->
                                <?php echo $recomienda['message']->renderError() ?>
                            </td>
                        </tr>
                        <?php if ($recomienda['message']->hasError()): ?>
                            <style type="text/css">
                                span.cke_skin_kama {
                                    border: 2px solid red;
                                }
                            </style>
                        <?php endif; ?>
                        <tr>
                            <td ><?php echo $recomienda['message']->render() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong><?php echo __('*Datos requeridos') ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" class="red_button" value="<?php echo __('recomiéndanos') ?>" id="enviar" title="Envía formulario para recomendarnos a un amigo"/>&nbsp;<?php echo link_to("cancela", "concurso/index", array('title' => 'cancela')) ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
    </form>


    <div class="hidden" id="user_messagebox">
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
    <a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user_messagebox").fancybox({padding: 5});

            if (<?php echo $sf_user->hasFlash('recomienda') ? 1 : 0 ?>) {
                $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('recomienda')) ?>');
                $("#user_messagebox").trigger('click');
            }
        });

    </script>

    <script type="text/javascript">
        $("#enviar").click(function() {
            $('#recomienda_emails option').attr("selected", "selected");
            $(this).removeClass("red_button");
            $(this).addClass("gray_button");
            $(this).attr('disabled', 'disabled');
        });

        $('#add').click(function() {

            if ($('#recomienda_emails option').size() == 10)
                alert('El número máximo son 10');
            else {

                nombre = $('#nombre').val();
                email = $('#email').val();
                var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

                error = false;
                if (!filter.test(email))
                    error = true;
                if (!nombre.length > 0)
                    error = true;

                if (error) {
                    alert('Email o nombre no validos');
                } else {
                    $('#nombre').val('');
                    $('#email').val('');
                    valor = "<option>" + nombre + ";" + email + "</option>";
                    $('#recomienda_emails').append(valor);
                    //alert(nombre+";"+email);
                }
            }
        });

        $('#delete').click(function() {
            $("#recomienda_emails option:selected").remove();
        });


    </script>
</div>
<style type="text/css">
    input.errorInviteFrm{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.border-box:eq(5) .top-right tr:eq(1) td').prepend('<div id="max_length_error" style="display:none;  margin-bottom:10px;"><ul class="error_list"><li>Has superado el espacio permitido para tu mensaje.</li></ul></div>');
    });
</script>