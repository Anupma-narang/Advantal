
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('global.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>

<div id="content_breadcroum" class="cg1-color">
    <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio', 'class' => 'cg1-color')) ?> >> <?php echo link_to("Contáctanos", "nosotros/contactanos", array('title' => 'contáctanos', 'class' => 'cg1-color')) ?>
</div>
<h1><?php echo __('Contáctanos'); ?></h1>
<div id="content_contactanoss_nuevo">
    <form action="<?php echo url_for('nosotros/contactanos') ?>" method="post" <?php $contactanosForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if ($sf_user->hasFlash('errorContact')): ?>
            <ul class="error_list">
                <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorContact', ESC_RAW) ?></li>
            </ul>
        <?php endif; ?>
        <?php echo $contactanosForm->renderHiddenFields(); ?>
        <div style="clear: both"></div>
        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both"><?php echo __('TUS DATOS DE CONTACTO'); ?></h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">

                    <table style="width: 100%">
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['nombre']->renderError() ?></td>
                        </tr>

                        <tr>
                            <td style="width:200px"><?php echo $contactanosForm['nombre']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td>
                                <?php $nombClass = ''; ?>
                                <?php if ($contactanosForm['nombre']->hasError()): ?>
                                    <?php $nombClass = 'errorContact'; ?>
                                <?php endif; ?>
                                <?php if ($profile): ?>
                                    <?php echo $profile->getUsername(); ?>
                                    <?php echo $contactanosForm['nombre']->render(array('class' => 'hidden')) ?>
                                <?php else: ?>
                                    <?php echo $contactanosForm['nombre']->render(array('class' =>'visible32 ' . $nombClass)) ?>
                                <?php endif; ?>
                                <?php echo $contactanosForm['user_id']->render(array('class' => 'hidden')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['apellido1']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $contactanosForm['apellido1']->renderLabel(null, array('class' => 'bundle')) ?>
                            </td>
                            <td >
                                <?php $apellido1Class = ''; ?>
                                <?php if ($contactanosForm['apellido1']->hasError()): ?>
                                    <?php $apellido1Class = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    <?php echo $profile->getSurname1(); ?>
                                    <?php echo $contactanosForm['apellido1']->render(array('class' => 'hidden ' . $apellido1Class)) ?>
                                <?php else: ?>
                                    <?php echo $contactanosForm['apellido1']->render(array('class' =>'visible32 '. $apellido1Class)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['apellido2']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $contactanosForm['apellido2']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td >
                                <?php $apellido2Class = ''; ?>
                                <?php if ($contactanosForm['apellido2']->hasError()): ?>
                                    <?php $apellido2Class = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    <?php echo $profile->getSurname2(); ?>
                                    <?php echo $contactanosForm['apellido2']->render(array('class' => 'hidden ' . $apellido2Class)) ?>
                                <?php else: ?>
                                    <?php echo $contactanosForm['apellido2']->render(array('class' =>'visible32 '. $apellido2Class)) ?>
                                <?php endif; ?>


                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['email']->renderError() ?></td>
                        </tr>

                        <tr>
                            <td><?php echo $contactanosForm['email']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td>
                                <?php $emailClass = ''; ?>
                                <?php if ($contactanosForm['email']->hasError()): ?>
                                    <?php $emailClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    <?php echo $profile->getEmail(); ?>
                                    <?php echo $contactanosForm['email']->render(array('class' => 'hidden ' . $emailClass)) ?>
                                <?php else: ?>
                                    <?php echo $contactanosForm['email']->render(array('class' =>'visible32 '. $emailClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['phone']->renderError() ?></td>
                        </tr>

                        <tr>
                            <td><?php echo $contactanosForm['phone']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <?php $phoneClass = ''; ?>
                            <?php if ($contactanosForm['phone']->hasError()): ?>
                                <?php $phoneClass = 'errorContact'; ?>
                            <?php endif; ?>
                            <td ><?php echo $contactanosForm['phone']->render(array('class' => 'tamano_9_c ' . $phoneClass)) ?></td>
                        </tr>


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
                    <h2 style="clear: both"><?php echo __('TUS IDEAS, COMENTARIOS O SUGERENCIAS*'); ?></h2>
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
                    <table>
                        <tr>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul class="error_list" id="error_max_length" style="display: none;">
                                    <li style="font-weight:bold;">Has superado el espacio permitido para tu comentario.</li>
                                </ul>
                                <?php echo $contactanosForm['comentario']->renderError(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm['comentario'] ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"><br/><?php echo __('Añadir archivos') ?></td>
                        </tr>
                        <?php  $current_uploads = $sf_request->getFiles($contactanosForm->getName()); ?>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm["fichero1"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_1">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $contactanosForm["fichero1"] ?></span>
                            </td><td><span style="padding-left:15px;">
                                    <input type="button" id="file1_addmore" value="+" />
                                    <input type="button" id="file1_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm["fichero2"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_2">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $contactanosForm["fichero2"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file2_addmore" value="+" />
                                    <input type="button" id="file2_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm["fichero3"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_3">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $contactanosForm["fichero3"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file3_addmore" value="+" />
                                    <input type="button" id="file3_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm["fichero4"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_4">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $contactanosForm["fichero4"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file4_addmore" value="+" />
                                    <input type="button" id="file4_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $contactanosForm["fichero5"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_5">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $contactanosForm["fichero5"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file5_delete" value="-" />
                                </span></td>
                        </tr>

                        <?php /* <tr>
                          <td colspan="2"><br/><?php echo __('Añadir archivos') ?></td>
                          </tr>
                          <tr>
                          <td colspan="2">
                          <?php echo $contactanosForm["fichero1"]->renderError(); ?>
                          <?php echo $contactanosForm["fichero2"]->renderError(); ?>
                          <?php echo $contactanosForm["fichero3"]->renderError(); ?>
                          <?php echo $contactanosForm["fichero4"]->renderError(); ?>
                          <?php echo $contactanosForm["fichero5"]->renderError(); ?>
                          </td>
                          </tr>
                          <tr>
                          <td colspan="2"><?php echo $contactanosForm["fichero1"] ?> <?php echo button_to_function('+', '$("#contactanos_fichero2").click(); $("#fichero2").show();$("#ficherod1").hide()', array('id' => 'ficherob1', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#contactanos_fichero1").val("");$("#ficherob1").hide();$("#ficherod1").hide();', array('id' => 'ficherod1', 'style' => 'display:none')) ?>
                          </td>
                          </tr>
                          <tr id="fichero2" style="display: none">
                          <td colspan="2"><?php echo $contactanosForm["fichero2"] ?> <?php echo button_to_function('+', '$("#contactanos_fichero3").click();$("#fichero3").show()', array('id' => 'ficherob2', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#fichero2").hide();$("#ficherob2").hide();$("#contactanos_fichero2").val("");$("#ficherod1").show()') ?>
                          </td>
                          </tr>
                          <tr id="fichero3" style="display: none">
                          <td colspan="2"><?php echo $contactanosForm["fichero3"] ?> <?php echo button_to_function('+', '$("#contactanos_fichero4").click();$("#fichero4").show()', array('id' => 'ficherob3', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#fichero3").hide();$("#ficherob3").hide();$("#contactanos_fichero3").val("")') ?>
                          </td>
                          </tr>
                          <tr id="fichero4" style="display: none">
                          <td colspan="2"><?php echo $contactanosForm["fichero4"] ?> <?php echo button_to_function('+', '$("#contactanos_fichero5").click();$("#fichero5").show()', array('id' => 'ficherob4', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#fichero4").hide();$("#ficherob4").hide();$("#contactanos_fichero4").val("")') ?>
                          </td>
                          </tr>
                          <tr id="fichero5" style="display: none">
                          <td colspan="2"><?php echo $contactanosForm["fichero5"] ?> <?php echo button_to_function('-', '$("#fichero5").hide();$("#contactanos_fichero5").val("")') ?>
                          </td>
                          </tr> */ ?>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong><?php echo __('*Datos requeridos') ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="envía" id="prof_submit" class="red_button">&nbsp;<?php echo link_to("cancela", "nosotros/contactanos/index", array('title' => 'cancela')); ?>
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
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
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
<?php if ($contactanosForm['comentario']->hasError()): ?>
    <style type="text/css">
        span.cke_skin_kama {
            border: 2px solid red;
        }

    </style>
<?php endif; ?>
<style type="text/css">
    input.errorContact{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    ul.error_list li {
        background-attachment: scroll;
        background-color: transparent;
        background-position: 4px 5px;
        background-repeat: no-repeat;
        background-size: auto auto;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: bold;
        list-style: none outside none;
        padding: 0 0 0 25px;
        margin: 0px;
    }
    .visible32{
            width : 258px;
        }

</style>


<script type="text/javascript">
    $(document).ready(function() {

        for (i = 1; i <= 5; i++)
            $("input.file_" + i).filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});

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
            $('#contactanos_fichero2_newfile').trigger('click');
        });
        $("#file1_delete").click(function() {
            $('#contactanos_archivo_1_file_newfile').attr({value: ''});
            $('#contactanos_archivo_1_file_persistid').attr({value: ''});
            $('.file_1').attr({value: ''});
            $('#filename_uploaded1').hide();
            $("#file1_delete").hide();
            $('#file_1').show();
        });

        $("#file2_addmore").click(function() {
            $("#Archivo_3").show();
            $('#contactanos_fichero3_newfile').trigger('click');
        });
        $("#file2_delete").click(function() {
            $('#contactanos_archivo_2_file_newfile').attr({value: ''});
            $('#contactanos_archivo_2_file_persistid').attr({value: ''});
            $('.file_2').attr({value: ''});
            $('#filename_uploaded2').hide();
            $("#Archivo_2").hide();
            $('#file_2').show();
        });

        $("#file3_addmore").click(function() {
            $("#Archivo_4").show();
            $('#contactanos_fichero4_newfile').trigger('click');
        });
        $("#file3_delete").click(function() {
            $('#contactanos_archivo_3_file_newfile').attr({value: ''});
            $('#contactanos_archivo_3_file_persistid').attr({value: ''});
            $('.file_3').attr({value: ''});
            $('#filename_uploaded3').hide();
            $("#Archivo_3").hide();
            $('#file_3').show();
        });

        $("#file4_addmore").click(function() {
            $("#Archivo_5").show();
            $('#contactanos_fichero5_newfile').trigger('click');
        });
        $("#file4_delete").click(function() {
            $('#contactanos_archivo_4_file_newfile').attr({value: ''});
            $('#contactanos_archivo_4_file_persistid').attr({value: ''});
            $('.file_4').attr({value: ''});
            $('#filename_uploaded4').hide();
            $("#Archivo_4").hide();
            $('#file_4').show();
        });

        $("#file5_delete").click(function() {
            $('#contactanos_archivo_5_file_newfile').attr({value: ''});
            $('#contactanos_archivo_5_file_persistid').attr({value: ''});
            $('.file_5').attr({value: ''});
            $('#filename_uploaded5').hide();
            $("#Archivo_5").hide();
            $('#file_5').show();
        });


        // old script
        /*$("#contactanos_fichero1").change(function() {
      if ($(this).val()) {
        $("#ficherob1").show();
        $("#ficherod1").show();
      }
      else {
        $("#ficherob1").hide();
        $("#ficherod1").hide();
      }
    });
    $("#contactanos_fichero2").change(function() {
      if ($(this).val())
        $("#ficherob2").show();
    });
    $("#contactanos_fichero3").change(function() {
      if ($(this).val())
        $("#ficherob3").show();
    });
    $("#contactanos_fichero4").change(function() {
      if ($(this).val())
        $("#ficherob4").show();
    });*/

        $("input#prof_submit").click(function() {
            $("input#prof_submit").removeClass("red_button");
            $("input#prof_submit").addClass("gray_button");
            $("input#prof_submit").attr('disabled', 'disabled');
            $("form").submit();
        });

        $("#user_messagebox").fancybox({padding: 5});


        CKEDITOR.on('instanceCreated', function(e) {
            if (e.editor.name == editorId) { //editorId is the id of the textarea
                e.editor.on('change', function(evt) {
                    //Text change code
                    //console.log('a');
                });
            }
        });

    });
</script>
