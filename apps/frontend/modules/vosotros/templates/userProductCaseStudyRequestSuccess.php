<?php use_helper('jQuery'); ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>
<?php include_partial('breadcrumb', array('section' => $section, 'sub_section' => 'Producto', 'request_type' => 'product')); ?>
<div id="content_concursos_buscador" style="margin: 15px 67px 0 10px;">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <a class="" href="/vosotros/userCompanyCaseStudyRequest">Empresa/Entidad </a>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <a class="active" href="/vosotros/userProductCaseStudyRequest">Producto</a>
        </span>
    </div>
</div>

<div id="content_concursos_nuevo">
    <h1>Caso de éxito de Producto</h1>
    <?php if ($sf_user->hasFlash('errorproductstudy')): ?>
        <ul class="error_list">
            <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorproductstudy', ESC_RAW) ?></li>
        </ul>
    <?php endif; ?>
    <form action="<?php echo url_for('vosotros/userProductCaseStudyRequest') ?>" id="form_" method="post" <?php $product_request_form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both">DATOS DEL PRODUCTO</h2>
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

                    <table style="width: 100%" class="userProdSuccessRes">
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['user_name']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $product_request_form['user_name']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['user_name']->render(array('class' => 'tamano_32_c ac_input gray-out', 'readonly' => 'readonly')) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['name']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $nameError = (($product_request_form['name']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['name']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td><?php echo $product_request_form['name']->render(array('class' => 'tamano_32_c ' . $nameError)) ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"><?php echo $product_request_form['producto_tipo_uno_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $producto_uno_Error = (($product_request_form['producto_tipo_uno_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['producto_tipo_uno_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['producto_tipo_uno_id']->render(array('class' => $producto_uno_Error)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['producto_tipo_dos_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $producto_dos_Error = (($product_request_form['producto_tipo_dos_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['producto_tipo_dos_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['producto_tipo_dos_id']->render(array('class' => $producto_dos_Error)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['producto_tipo_tres_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $producto_tres_Error = (($product_request_form['producto_tipo_tres_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['producto_tipo_tres_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['producto_tipo_tres_id']->render(array('class' => $producto_tres_Error)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['marca']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $marcaError = (($product_request_form['marca']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['marca']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['marca']->render(array('class' => 'tamano_32_c ' . $marcaError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['modelo']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $modeloError = (($product_request_form['modelo']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['modelo']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['modelo']->render(array('class' => 'tamano_20_c ' . $modeloError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['homepage']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $pro_homepageError = (($product_request_form['homepage']->hasError()) ? 'errorstudy' : ''); ?>
                            <td><?php echo $product_request_form['homepage']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td ><?php echo $product_request_form['homepage']->render(array('class' => 'tamano_32_c ' . $pro_homepageError)) ?></td>
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
                    <h2 style="clear: both">DESCRIPCIÓN DE TU CASO DE ÉXITO*</h2>
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
                    <table>
                        <tr>
                            <td><?php echo $product_request_form['description']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['description']->render() ?></td>
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
                    <h2 style="clear: both">RESUMEN DE TU CASO DE ÉXITO*</h2>
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
                    <table>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['summary']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form['summary']->render() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo __('Añadir el logotipo'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php echo $product_request_form["logo"]->render() ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><br><?php echo __('Añadir archivo'); ?></td>
                        </tr>
                        
                        
                         <tr>
                            <td colspan="2"><?php echo $product_request_form["file1"]->renderError() ?></td>
                        </tr>
                       <tr id="Archivo_1">
                            <td style="width:300px;" >
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $product_request_form["file1"] ?></span>
                            </td><td><span style="padding-left:15px;">
                                    <input type="button" id="file1_addmore" value="+" />
                                    <input type="button" id="file1_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form["file2"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_2">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $product_request_form["file2"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file2_addmore" value="+" />
                                    <input type="button" id="file2_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form["file3"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_3">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $product_request_form["file3"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file3_addmore" value="+" />
                                    <input type="button" id="file3_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $product_request_form["file4"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_4">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $product_request_form["file4"] ?></span>
                               </td><td> <span style="padding-left:15px;">
                                    
                                    <input type="button" id="file4_delete" value="-" />
                                </span></td>
                        </tr>

                        
                        
                       <?php /* <tr>
                            <td colspan="2">
                                <?php echo $product_request_form["file1"]->renderError() ?>
                                <?php //echo $product_request_form["file2"]->renderError() ?>
                                <?php //echo $product_request_form["file3"]->renderError() ?>
                                <?php //echo $product_request_form["file4"]->renderError() ?>

                            </td>
                        </tr>
                        <?php 
                        <tr>
                            <td colspan="2">

                                <?php echo $product_request_form["file1"]->render() ?> <?php //echo button_to_function('+', '$("#contactanos_fichero2").click(); $("#Archivo_2").show();$("#Archivo_d1").hide()', array('id' => 'Archivo_b1', 'style' => 'display:none')) ?><?php //echo button_to_function('-', '$("#contactanos_fichero1").val("");$("#Archivo_b1").hide();$("#Archivo_d1").hide();', array('id' => 'Archivo_d1', 'style' => 'display:none')) ?>
                            </td>
                        </tr>
                        <!--<tr id="Archivo_2" style="display: none">
                            <td colspan="2">

                        <?php // echo $product_request_form["file2"] ?> <?php echo button_to_function('+', '$("#contactanos_fichero3").click();$("#Archivo_3").show()', array('id' => 'Archivo_b2', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_2").hide();$("#Archivo_b2").hide();$("#contactanos_fichero2").val("");$("#Archivo_d1").show()') ?>
                            </td>
                        </tr>
                        <tr id="Archivo_3" style="display: none">
                            <td colspan="2"><?php //echo $product_request_form["file3"]     ?> <?php echo button_to_function('+', '$("#contactanos_fichero4").click();$("#Archivo_4").show()', array('id' => 'Archivo_b3', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_3").hide();$("#Archivo_b3").hide();$("#contactanos_fichero3").val("")') ?>
                            </td>
                        </tr>
                        <tr id="Archivo_4" style="display: none">
                            <td colspan="2"><?php //echo $product_request_form["file4"]     ?> <?php echo button_to_function('+', '$("#contactanos_fichero5").click();$("#Archivo_5").show()', array('id' => 'Archivo_b4', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_4").hide();$("#Archivo_b4").hide();$("#contactanos_fichero4").val("")') ?>
                            </td>
                        </tr>--> */ ?>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>*Datos requeridos</strong></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">
                                <input id="user_product_submit" type="submit" value="envía" class="red_button">
                                <a href="/vosotros/companyCaseStudy">cancela</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <?php echo $product_request_form->renderHiddenFields(); ?>
    </form>
</div>
<?php if ($product_request_form['description']->hasError()): ?>
    <style type="text/css">
        span#cke_user_product_case_study_request_description {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>
<?php if ($product_request_form['summary']->hasError()): ?>
    <style type="text/css">
        span#cke_user_product_case_study_request_summary {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>

<style type="text/css">
    select.errorstudy,
    input.errorstudy{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>
<script type="text/javascript">
    for (i = 1; i <= 4; i++) {
        $("input.file_" + i).filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
    }
    $("input#user_product_case_study_request_logo_newfile").filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
    if ($('#filename_uploaded').length) {
       // $("#file1_delete").show();
        $('#file_').hide();
    }
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
    $('.file_1').change(function() {
        $("#file1_delete").show();
    });

    $("#file1_addmore").click(function() {
        $("#Archivo_2").show();
        $('#user_product_case_study_request_file2_newfile').trigger('click');
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
        $('#user_product_case_study_request_file3_newfile').trigger('click');
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
        $('#user_product_case_study_request_file4_newfile').trigger('click');
    });
    $("#file3_delete").click(function() {
        $('#auditanos_archivo_3_file_newfile').attr({value: ''});
        $('#auditanos_archivo_3_file_persistid').attr({value: ''});
        $('.file_3').attr({value: ''});
        $('#filename_uploaded3').hide();
        $("#Archivo_3").hide();
        $('#file_3').show();
    });
    $("#file4_delete").click(function() {
        $('#auditanos_archivo_4_file_newfile').attr({value: ''});
        $('#auditanos_archivo_4_file_persistid').attr({value: ''});
        $('.file_4').attr({value: ''});
        $('#filename_uploaded4').hide();
        $("#Archivo_4").hide();
        $('#file_4').show();
    });
    
    
    $("input#user_product_submit").click(function() {
        $("input#user_product_submit").attr('disabled', 'disabled');
        $("input#user_product_submit").removeClass("red_button");
        $("input#user_product_submit").addClass("gray_button");
        $('#form_').submit();
    });

 


    function disableSectorTres() {
        if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() <= 1 && $('#user_product_case_study_request_producto_tipo_dos_id option').size() > 1) {
            $('#user_product_case_study_request_producto_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona tipo de producto</option>');
            $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#user_product_case_study_request_producto_tipo_tres_id').removeAttr('disabled');
    }
    $("#user_product_case_study_request_producto_tipo_uno_id").change(function() {
        if ($('#user_product_case_study_request_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#user_product_case_study_request_producto_tipo_uno_id option:selected').val());
        }
    });

    $("#user_product_case_study_request_producto_tipo_dos_id").change(function() {
        disableSectorTres();
        if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#user_product_case_study_request_producto_tipo_dos_id option:selected').val());
        }
    });
    $('#user_product_case_study_request_producto_tipo_dos_id').change(function() {
        if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() == 1) {
            $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
    });

    $('#user_product_case_study_request_producto_tipo_dos_id').each(function() {
        //alert($('#concurso_producto_tipo_dos_id option:selected').val());
        if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val()) {
            if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() == 1) {
                $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
            }
        }
    });
    // on ready
    $(function() {
        if ($("#user_product_case_study_request_producto_tipo_uno_id").length > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#user_product_case_study_request_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#user_product_case_study_request_producto_tipo_uno_id option:selected').val());
        }
        if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#user_product_case_study_request_producto_tipo_dos_id option:selected').val());
        }
    });

    $('.border-box:eq(3) .top-right tr:eq(1) td').prepend('<div id="error_max_length" style="display:none; margin-bottom:10px;"><ul class="error_list"><li>Has superado el espacio permitido para la descripción del caso de éxito.</li></ul></div>');
    $('.border-box:eq(5) .top-right tr:eq(1) td').prepend('<div id="error_max_length_summary" style="display:none;  margin-bottom:10px;"><ul class="error_list"><li>Has superado el espacio permitido para el resumen de tu caso de éxito.</li></ul></div>');


</script>