<?php use_helper('jQuery'); ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>
<?php include_partial('breadcrumb', array('section' => $section, 'sub_section' => 'Empresa/Entidad ', 'request_type' => 'company')); ?>
<div id="content_concursos_buscador" style="margin: 15px 67px 0 10px;">
    <div id="boton_no_activo">
        <span class="concurso_link"><a class="active" href="/vosotros/userCompanyCaseStudyRequest">Empresa/Entidad</a>    </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link"><a class="" href="/vosotros/userProductCaseStudyRequest">Producto</a>    </span>
    </div>
</div>
<div id="content_concursos_nuevo">
    <h1>Caso de éxito de Empresa/Entidad</h1>
    <form enctype="multipart/form-data" id="form_" action="<?php echo url_for('vosotros/userCompanyCaseStudyRequest') ?>" method="post" <?php $company_request_form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if ($sf_user->hasFlash('errorcompanystudy')): ?>
            <ul class="error_list">
                <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorcompanystudy', ESC_RAW) ?></li>
            </ul>
        <?php endif; ?>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both">DATOS DE LA EMPRESA/ENTIDAD</h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <table width="100%">
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['user_name']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['user_name']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td colspan="2"><?php echo $company_request_form['user_name']->render(array('class' => 'tamano_32_c ac_input gray-out', 'readonly' => 'readonly')) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['name']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $nameError = (($company_request_form['name']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['name']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['name']->render(array('class' => 'tamano_32_c ' . $nameError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['empresa_sector_uno_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $sectorError = (($company_request_form['empresa_sector_uno_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['empresa_sector_uno_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['empresa_sector_uno_id']->render(array('class' => $sectorError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['empresa_sector_dos_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $subsectorError = (($company_request_form['empresa_sector_dos_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['empresa_sector_dos_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['empresa_sector_dos_id']->render(array('class' => $subsectorError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['empresa_sector_tres_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $actividadError = (($company_request_form['empresa_sector_tres_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['empresa_sector_tres_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['empresa_sector_tres_id']->render(array('class' => $actividadError)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo $company_request_form['homepage']->renderError() ?></td>
                        </tr>
                        <tr>
                            <?php $paginaWebError = (($company_request_form['homepage']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['homepage']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['homepage']->render(array('class' => 'tamano_32_c ' . $paginaWebError)) ?></td>
                        </tr>
                        <tr>
                            <td  colspan="2"><?php echo $company_request_form['road_type_id']->renderError() ?></td>
                            <td  colspan="2"><?php echo $company_request_form['direccion']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['road_type_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td colspan="2"><?php echo $company_request_form['direccion']->renderLabel(null, array('class' => 'bundle')) ?></td>
                        </tr>
                        <tr>
                            <?php $tipoError = (($company_request_form['road_type_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <?php $directionWebError = (($company_request_form['direccion']->hasError()) ? 'errorstudy' : ''); ?>
                            <td  colspan="2"><?php echo $company_request_form['road_type_id']->render(array('style' => 'margin-left:20px;', 'class' => $tipoError)) ?></td>
                            <td  colspan="2"><?php echo $company_request_form['direccion']->render(array('style' => 'margin-left:20px;', 'class' => 'tamano_32_c ' . $directionWebError)) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $company_request_form['numero']->renderError() ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['piso']->renderError() ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['puerta']->renderError() ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['cp']->renderError() ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $company_request_form['numero']->renderLabel(null, array('class' => 'bundle')) ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['piso']->renderLabel(null, array('class' => 'bundle')) ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['puerta']->renderLabel(null, array('class' => 'bundle')) ?>
                            </td>
                            <td>
                                <?php echo $company_request_form['cp']->renderLabel(null, array('class' => 'bundle')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php $numeroError = (($company_request_form['numero']->hasError()) ? 'errorstudy' : ''); ?>
                                <?php echo $company_request_form['numero']->render(array('style' => 'margin-left:20px;width:41px;', 'class' => $numeroError)) ?>
                            </td>
                            <td>
                                <?php $pisoError = (($company_request_form['piso']->hasError()) ? 'errorstudy' : ''); ?>
                                <?php echo $company_request_form['piso']->render(array('style' => 'margin-left:20px;', 'class' => 'tamano_2_c ' . $pisoError)) ?>
                            </td>
                            <td>
                                <?php $puertaError = (($company_request_form['puerta']->hasError()) ? 'errorstudy' : ''); ?>
                                <?php echo $company_request_form['puerta']->render(array('style' => 'margin-left:20px;', 'class' => 'tamano_4_c ' . $puertaError)) ?>
                            </td>
                            <td>
                                <?php $cpError = (($company_request_form['cp']->hasError()) ? 'errorstudy' : ''); ?>
                                <?php echo $company_request_form['cp']->render(array('style' => 'margin-left:20px;', 'class' => 'tamano_5_c ' . $cpError)) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['states_id']->renderError() ?></td>
                            <td colspan="2"><?php echo $company_request_form['city_id']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['states_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            <td colspan="2"><?php echo $company_request_form['city_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                        </tr>
                        <tr>
                            <?php $states_idError = (($company_request_form['states_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <?php $city_idError = (($company_request_form['city_id']->hasError()) ? 'errorstudy' : ''); ?>
                            <td colspan="2"><?php echo $company_request_form['states_id']->render(array('style' => 'margin-left:20px;', 'class' => $states_idError)) ?></td>
                            <td colspan="2"><?php echo $company_request_form['city_id']->render(array('style' => 'margin-left:20px;', 'class' => $city_idError)) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both">DESCRIPCIÓN DE TU CASO DE ÉXITO*</h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <table>
                        <tr>
                            <td><?php echo $company_request_form['description']->renderError() ?>
                                <div style="margin-bottom: 10px; display:none" id="error_max_length"><ul class="error_list"><li>Has superado el espacio permitido para la descripción de tu caso de éxito.</li></ul></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['description']->render() ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <h2 style="clear: both">RESUMEN DE TU CASO DE ÉXITO*</h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="border-box">
            <div class="header-left"><div class="header-right"></div></div><div class="top-left">
                <div class="top-right">
                    <table>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['summary']->renderError() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form['summary']->render() ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="float:left; margin-top: 0px;"><?php echo __('Añadir el logotipo'); ?></td>
                        </tr>
                        <tr id="logo">
                            <td colspan="2">
                                <?php echo $company_request_form["logo"]->render() ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><br><?php echo __('Añadir archivo'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form["file1"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_1">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $company_request_form["file1"] ?></span>
                            </td><td><span style="padding-left:15px;">
                                    <input type="button" id="file1_addmore" value="+" />
                                    <input type="button" id="file1_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form["file2"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_2">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $company_request_form["file2"] ?></span>
                            </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file2_addmore" value="+" />
                                    <input type="button" id="file2_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form["file3"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_3">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $company_request_form["file3"] ?></span>
                            </td><td> <span style="padding-left:15px;">
                                    <input type="button" id="file3_addmore" value="+" />
                                    <input type="button" id="file3_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $company_request_form["file4"]->renderError() ?></td>
                        </tr>
                        <tr id="Archivo_4">
                            <td style="width:300px;">
                                <span title="Añade un archivo para complementar tu contactanos de ideas"><?php echo $company_request_form["file4"] ?></span>
                            </td><td> <span style="padding-left:15px;">

                                    <input type="button" id="file4_delete" value="-" />
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Datos requeridos*</strong></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">
                                <input id="user_company_submit" type="submit" value="envía" class="red_button">
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
        <?php echo $company_request_form->renderHiddenFields(); ?>
    </form>
</div>
<?php if ($company_request_form['description']->hasError()): ?>
    <style type="text/css">
        span#cke_user_company_case_study_request_description {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>
<?php if ($company_request_form['summary']->hasError()): ?>
    <style type="text/css">
        span#cke_user_company_case_study_request_summary {
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
    sortProvinciaList("user_company_case_study_request_states_id");
    for (i = 1; i <= 4; i++) {
        $("input.file_" + i).filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
    }
    $("input#user_company_case_study_request_logo_newfile").filestyle({image: "/images/fichero.png", imagewidth: 118, width: 150});
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
        $('#user_company_case_study_request_file2_newfile').trigger('click');
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
        $('#user_company_case_study_request_file3_newfile').trigger('click');
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
        $('#user_company_case_study_request_file4_newfile').trigger('click');
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

    $("input#user_company_submit").click(function() {
        $("input#user_company_submit").attr('disabled', 'disabled');
        $("input#user_company_submit").removeClass("red_button");
        $("input#user_company_submit").addClass("gray_button");
        $('#form_').submit();

    });

    $('#user_company_case_study_request_empresa_sector_dos_id').change(function() {
        if ($('#user_company_case_study_request_empresa_sector_tres_id option').size() == 1) {
            $('#user_company_case_study_request_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
    });

    $('#user_company_case_study_request_empresa_sector_dos_id').each(function() {
        if ($('#user_company_case_study_request_empresa_sector_dos_id option:selected').val()) {
            if ($('#user_company_case_study_request_empresa_sector_tres_id option').size() == 1) {
                $('#user_company_case_study_request_empresa_sector_tres_id').attr('disabled', 'disabled');
            }
        }
    });

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
    ?>

        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $("#user_company_case_study_request_states_id").change(function() {
        ceuta_melilla($(this), $("#user_company_case_study_request_city_id"))
    });
    $("form").bind("submit", function() {
        $("#user_company_case_study_request_city_id").removeAttr("disabled");
    });
    ceuta_melilla($("#user_company_case_study_request_states_id"), $("#user_company_case_study_request_city_id"));
    $('.border-box:eq(4) .top-right tr:eq(1) td').prepend('<div id="error_max_length" style="display:none; margin-bottom:10px;"><ul class="error_list"><li>Has superado el espacio permitido para la descripción del caso de éxito.</li></ul></div>');
    $('.border-box:eq(5) .top-right tr:eq(1) td').prepend('<div id="error_max_length_summary" style="display:none;  margin-bottom:10px;"><ul class="error_list"><li>Has superado el espacio permitido para el resumen de tu caso de éxito.</li></ul></div>');
</script>