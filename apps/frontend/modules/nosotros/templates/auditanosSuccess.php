<?php use_helper('jQuery'); ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>

<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'audítanos', 'tituloSeccion' => 'audítanos')) ?>
<h1><?php echo __('Audítanos'); ?></h1>
<div id="content_concursos_nuevo">
    <div id="Flash" class="border-box">
        <?php if ($sf_user->hasFlash('auditanos')): ?>
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">
                    <div class="close" title="cierra este mensaje"></div>
                    <div class="flash_notice">
                        <?php echo $sf_user->getFlash('auditanos', ESC_RAW) ?>
                    </div>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        <?php endif; ?>
    </div>
    <form action="<?php echo url_for('nosotros/auditanos') ?>" id="form_" method="post" <?php $auditanosForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php echo $auditanosForm->renderGlobalErrors(); ?>
        <?php echo $auditanosForm->renderHiddenFields(); ?>

        <?php if ($sf_user->hasFlash('errorAuditanos')): ?>
            <ul class="error_list">
                <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorAuditanos', ESC_RAW) ?></li>
            </ul>
        <?php endif; ?>

        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">
                <div class="header-right"></div>
            </div>
            <div class="top-left">
                <div class="top-right">
                    <h2><?php echo __('TUS DATOS DE COLABORADOR'); ?></h2>
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

                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm['usuario']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><label for="auditanos_usuario" class="bundle">Tu Usuario/Alias</label></td>
                            <?php $usuarioClass = ''; ?>
                            <?php if ($auditanosForm['usuario']->hasError()): ?>
                                <?php $usuarioClass = 'errorAuditones'; ?>
                            <?php endif; ?>
                            <td><?php echo $auditanosForm['usuario']->render(array('class' => 'gray-out tamano_32_c ' . $usuarioClass, 'readonly' => 'readonly')) ?></td>
                        </tr>
                        <tr>

                            <td colspan="2"><?php echo $auditanosForm['email']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><label for="auditanos_usuario" class="bundle">Tu correo electrónico</label></td>
                            <?php $usuarioClass = ''; ?>
                            <?php if ($auditanosForm['email']->hasError()): ?>
                                <?php $usuarioClass = 'errorAuditones'; ?>
                            <?php endif; ?>
                            <td ><?php echo $auditanosForm['email']->render(array('class' => 'gray-out tamano_32_c ' . $usuarioClass, 'readonly' => 'readonly')) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm['phone']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><label for="auditanos_usuario" class="bundle">Tu teléfono de contacto</label></td>
                            <?php $usuarioClass = ''; ?>
                            <?php if ($auditanosForm['phone']->hasError()): ?>
                                <?php $usuarioClass = 'errorAuditones'; ?>
                            <?php endif; ?>
                            <td ><?php echo $auditanosForm['phone']->render(array('class' => 'tamano_9_c ' . $usuarioClass)) ?></td>
                        </tr>
                    </table>
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
                    <h2><?php echo __('TU PLAN DE ACCIÓN PARA MEJORAR AUDITOSCOPIA*'); ?></h2>
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
                    <table style="width: 600px" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left" colspan="2"><?php //echo $auditanosForm['plan']->renderLabel();                     ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul id="error_max_length" class="error_list" style="display:none">
                                    <li>Has superado el espacio permitido para tu Plan de acción.</li>
                                </ul>
                                <?php echo $auditanosForm['plan']->renderError() ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm['plan']->render() ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"><br/><?php echo __('Añadir archivos'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm["fichero1"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_1">
                           <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $auditanosForm["fichero1"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file1_addmore" value="+" />
                                    <input type="button" id="file1_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm["fichero2"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_2">
                            <td>
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $auditanosForm["fichero2"] ?></span>
                              </td><td>  <span style="padding-left:15px;">
                                    <input type="button" id="file2_addmore" value="+" />
                                    <input type="button" id="file2_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm["fichero3"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_3">
                            <td>
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $auditanosForm["fichero3"] ?></span>
                              </td><td>  <span style="padding-left:15px;">
                                    <input type="button" id="file3_addmore" value="+" />
                                    <input type="button" id="file3_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm["fichero4"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_4">
                            <td>
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $auditanosForm["fichero4"] ?></span>
                              </td><td>  <span style="padding-left:15px;">
                                    <input type="button" id="file4_addmore" value="+" />
                                    <input type="button" id="file4_delete" value="-" />
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $auditanosForm["fichero5"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_5">
                            <td>
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $auditanosForm["fichero5"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file5_delete" value="-" />
                                </span></td>
                        </tr>
                        <?php /* <tr>
                          <td colspan="2">
                          <?php echo $auditanosForm["fichero1"]->renderError() ?>
                          <?php echo $auditanosForm["fichero2"]->renderError() ?>
                          <?php echo $auditanosForm["fichero3"]->renderError() ?>
                          <?php echo $auditanosForm["fichero4"]->renderError() ?>
                          <?php echo $auditanosForm["fichero5"]->renderError() ?>
                          </td>
                          </tr>

                          <tr id="Archivo_1">
                          <td colspan="2" >
                          <?php echo $auditanosForm["fichero1"] ?>
                          <?php echo button_to_function('+', '$("#auditanos_fichero2_newfile").click(); $("#Archivo_2").show();$("#Archivo_d1").hide()', array('id' => 'Archivo_b1', 'style' => 'display:none')) ?>
                          <?php echo button_to_function('-', '$("#auditanos_fichero1_newfile").val("");$("#Archivo_b1").hide();$("#Archivo_d1").hide();', array('id' => 'Archivo_d1', 'style' => 'display:none')) ?>
                          </td>
                          </tr>
                          <tr id="Archivo_2" style="display: none">
                          <td colspan="2">
                          <?php echo $auditanosForm["fichero2"] ?>
                          <?php echo button_to_function('+', '$("#auditanos_fichero3_newfile").click();$("#Archivo_3").show()', array('id' => 'Archivo_b2', 'style' => 'display:none')) ?>
                          <?php echo button_to_function('-', '$("#Archivo_2").hide();$("#Archivo_b2").hide();$("#auditanos_fichero2_newfile").val("");$("#Archivo_d1").show()') ?>
                          </td>
                          </tr>
                          <tr id="Archivo_3" style="display: none">
                          <td colspan="2">
                          <?php echo $auditanosForm["fichero3"] ?>
                          <?php echo button_to_function('+', '$("#auditanos_fichero4_newfile").click();$("#Archivo_4").show()', array('id' => 'Archivo_b3', 'style' => 'display:none')) ?>
                          <?php echo button_to_function('-', '$("#Archivo_3").hide();$("#Archivo_b3").hide();$("#auditanos_fichero3_newfile").val("")') ?>
                          </td>
                          </tr>
                          <tr id="Archivo_4" style="display: none">
                          <td colspan="2">
                          <?php echo $auditanosForm["fichero4"] ?>
                          <?php echo button_to_function('+', '$("#auditanos_fichero5_newfile").click();$("#Archivo_5").show()', array('id' => 'Archivo_b4', 'style' => 'display:none')) ?>
                          <?php echo button_to_function('-', '$("#Archivo_4").hide();$("#Archivo_b4").hide();$("#auditanos_fichero4_newfile").val("")') ?>
                          </td>
                          </tr>
                          <tr id="Archivo_5" style="display: none">
                          <td colspan="2">
                          <?php echo $auditanosForm["fichero5"] ?>
                          <?php echo button_to_function('-', '$("#Archivo_5").hide();$("#auditanos_fichero5_newfile").val("")') ?>
                          </td>
                          </tr>
                         */ ?>
                        <tr>
                            <td class="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="2"><strong><?php echo __('*Datos requeridos') ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="envía" id="audit_submit" class="red_button">
                                <?php echo link_to('cancela', url_for('nosotros/audita'), array('title' => 'cancela')) ?>
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
</div>
<?php if ($auditanosForm['plan']->hasError()): ?>
    <style type="text/css">
        span.cke_skin_kama {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>
<style type="text/css">
    input.errorAuditones{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    ul.error_list{float: left; width: 573px; margin:4px 0 4px 0;}
    ul.error_list li{margin: 0;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("input#audit_submit").click(function() {
            $("input#audit_submit").removeClass("red_button");
            $("input#audit_submit").addClass("gray_button");
            $("input#audit_submit").attr('disabled', 'disabled');
            $('#form_').submit();
        });
    });

    for (i = 1; i <= 5; i++) {
        $("input.file_" + i).filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
    }
    /*
     *
     $("#auditanos_fichero1_newfile").change(function() {
     if ($(this).val()) {
     $("#Archivo_b1").show();
     $("#Archivo_d1").show();
     }
     else {
     $("#Archivo_b1").hide();
     $("#Archivo_d1").hide();
     }
     });

     $("#auditanos_fichero2_newfile").change(function() {
     if ($(this).val())
     $("#Archivo_b2").show();
     });

     $("#auditanos_fichero3_newfile").change(function() {
     if ($(this).val())
     $("#Archivo_b3").show();
     });

     $("#auditanos_fichero4_newfile").change(function() {
     if ($(this).val())
     $("#Archivo_b4").show();
     });*/
    if ($('#filename_uploaded1').length) {
        $("#file1_delete").show();
        $('#file_1').hide();
    } else {
        $("#file1_delete").hide();
    }
    if ($('#filename_uploaded2').length) {
        $("#Archivo_2").show();
        $('#file_2').hide();
    } else {
        $("#Archivo_2").hide();
    }
    if ($('#filename_uploaded3').length) {
        $("#Archivo_3").show();
        $('#file_3').hide();
    } else {
        $("#Archivo_3").hide();
    }
    if ($('#filename_uploaded4').length) {
        $("#Archivo_4").show();
        $('#file_4').hide();
    } else {
        $("#Archivo_4").hide();
    }
    if ($('#filename_uploaded5').length) {
        $("#Archivo_5").show();
        $('#file_5').hide();
    } else {
        $("#Archivo_5").hide();
    }

    $('.file_1').change(function() {
        $("#file1_delete").show();
    });

    $("#file1_addmore").click(function() {
        $("#Archivo_2").show();
        $('#auditanos_fichero2_newfile').trigger('click');
    });
    $("#file1_delete").click(function() {
        $('#auditanos_archivo_1_file_newfile').attr({value: ''});
        $('#auditanos_archivo_1_file_persistid').attr({value: ''});
        $('.file_1').attr({value: ''});
        $('#filename_uploaded1').hide();
        $("#file1_delete").hide();
        $('#file_1').show();
    });

    $("#file2_addmore").click(function() {
        $("#Archivo_3").show();
        $('#auditanos_fichero3_newfile').trigger('click');
    });
    $("#file2_delete").click(function() {
        $('#auditanos_archivo_2_file_newfile').attr({value: ''});
        $('#auditanos_archivo_2_file_persistid').attr({value: ''});
        $('.file_2').attr({value: ''});
        $('#filename_uploaded2').hide();
        $("#Archivo_2").hide();
        $('#file_2').show();
    });

    $("#file3_addmore").click(function() {
        $("#Archivo_4").show();
        $('#auditanos_fichero4_newfile').trigger('click');
    });
    $("#file3_delete").click(function() {
        $('#auditanos_archivo_3_file_newfile').attr({value: ''});
        $('#auditanos_archivo_3_file_persistid').attr({value: ''});
        $('.file_3').attr({value: ''});
        $('#filename_uploaded3').hide();
        $("#Archivo_3").hide();
        $('#file_3').show();
    });

    $("#file4_addmore").click(function() {
        $("#Archivo_5").show();
        $('#auditanos_fichero5_newfile').trigger('click');
    });
    $("#file4_delete").click(function() {
        $('#auditanos_archivo_4_file_newfile').attr({value: ''});
        $('#auditanos_archivo_4_file_persistid').attr({value: ''});
        $('.file_4').attr({value: ''});
        $('#filename_uploaded4').hide();
        $("#Archivo_4").hide();
        $('#file_4').show();
    });

    $("#file5_delete").click(function() {
        $('#auditanos_archivo_5_file_newfile').attr({value: ''});
        $('#auditanos_archivo_5_file_persistid').attr({value: ''});
        $('.file_5').attr({value: ''});
        $('#filename_uploaded5').hide();
        $("#Archivo_5").hide();
        $('#file_5').show();
    });
</script>
