<?php
use_helper('Form');
use_stylesheet('profesionals.css');
use_stylesheet('forms.css');
use_javascript('ckeditor/ckeditor.js');
use_javascript('jquery.filestyle.js');
$profesional_url = '/las-listas/directorio-de-buenos-profesionales/profesionales/' . $ssFirstName;
?>
<?php
$telephone_flag = false;
$email_flag = false;
?>
<div id="content_breadcroum" style="float:left">
    <?php echo link_to("Inicio", "home/index") ?>
    >>
    <?php echo link_to('Las Listas', 'listaBlanca/index') ?>
    >>
    <?php echo link_to('Directorio de buenos profesionales', 'directorio/index') ?>
    >>
    <strong><?php echo 'recomienda'; ?></strong>
</div>

<div id="content_laslistas_lista">
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('directorio', 'categoriaProfesional', array('url' => 'lista_profesional')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order"></div>
            </div>
            <div id="content-results1" class="main">
                <div class="top"></div>
                <div class="middle">
                    <div id="content_concursos_nuevo">
                        <div class="border-box ML-5 MR-2">
                            <div class="top-left">
                                <div class="top-right">
                                    <h2 style="text-align:center;"><?php echo 'CARTA DE RECOMENDACIÓN'; ?></h2>
                                </div>
                            </div>
                            <div class="bottom-left">
                                <div class="bottom-right"></div>
                            </div>
                        </div>
                        <?php if ($sf_user->hasFlash('error')): ?>
                            <ul class="error_list">
                                <li><?php echo $sf_user->getFlash('error', ESC_RAW) ?></li>
                            </ul>
                        <?php endif; ?>
                        <div style="clear:both;height:5px;"></div>
                        <?php echo $form->renderFormTag(url_for('profesional/' . $sf_params->get('action') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')), array("name" => "frmProfesionalRecomend", "id" => "frmProfesionalRecomend", "method" => "POST")); ?>
                        <?php echo input_hidden_tag('letter_id', $sf_params->get('letter_id'), array('readonly' => true)); ?>
                        <input type="hidden" name="idprofesional" value="<?php echo $sf_params->get('idprofesional') ?>" />
                        <input type="hidden" name="states_id" value="<?php echo $states_id ?>" />
                        <input type="hidden" name="city_id" value="<?php echo $city_id ?>" />
                        <div style="clear: both"></div>

                        <div class="border-box">
                            <?php if ($sf_user->hasFlash('notice')): ?>
                                <div id="Flash" class="flashMsgBox">
                                    <div class="flash_notice">
                                        <span class="close"><?php echo link_to_function('', "$('#Flash').hide('slow');") ?></span>
                                        <?php echo $sf_user->getFlash('notice', ESC_RAW) ?>
                                        <?php echo $sf_user->getFlash('nueva_contribucion', ESC_RAW) ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="grayBox">
                                    <?php $dataProfesional = $sf_data->getRaw('dataProfesional'); ?>
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="paddB5">
                                                    <tr>
                                                        <th align="left" width="35%"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['first_name']->renderLabel() ?></th>
                                                        <td width="65%"><?php echo $form['first_name']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['last_name_one']->renderLabel() ?></th>
                                                        <td><?php echo $form['last_name_one']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['last_name_two']->renderLabel() ?></th>
                                                        <td><?php echo $form['last_name_two']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tr>
                                                        <th width="35%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['profesional_tipo_uno_id']->renderLabel() ?></th>
                                                        <td width="65%"><?php echo $form['profesional_tipo_uno_id']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddB5" colspan="2"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tr>
                                                        <th width="35%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['profesional_tipo_dos_id']->renderLabel() ?></th>
                                                        <td width="65%"><?php echo $form['profesional_tipo_dos_id']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddB5" colspan="2"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php if ($dataProfesional['profesional_tipo_tres_id']): ?>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tr>
                                                            <th width="35%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['profesional_tipo_tres_id']->renderLabel() ?></th>
                                                            <td width="65%"><?php echo $form['profesional_tipo_tres_id']->render(array('class' => 'top-input1')) ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="2" style="padding-top: 8px;">
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <?php
                                                    if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == '' && $form['numero'] != '' && $form['address'] != '') {
                                                        $width1 = "44%";
                                                        $width_no = "25%";
                                                    } else {
                                                        $width1 = "55%";
                                                        $width_no = "15%";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <?php if (!empty($dataProfesional['road_type_id'])): ?>
                                                            <th align="left" width="35%"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['road_type_id']->renderLabel() ?></th>
                                                        <?php endif; ?>
                                                        <?php if (!empty($dataProfesional['address'])): ?>
                                                            <th align="left" width="<?php echo $width1; ?>">
                                                                <img src="/images/bulb.png" border="0" alt="" /><?php echo $form['address']->renderLabel() ?>
                                                            </th>
                                                        <?php endif; ?>
                                                        <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                                            <?php if (!empty($dataProfesional['numero'])): ?>
                                                                <th align="left" width="<?php echo $width_no; ?>"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['numero']->renderLabel() ?></th>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <th align="left" width="10%">&nbsp;</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <tr>
                                                        <?php if (!empty($dataProfesional['road_type_id'])): ?>
                                                            <td>
                                                                <?php echo $form['road_type_id']->render(array('class' => 'top-input2')) ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        <?php if (!empty($dataProfesional['address'])): ?>
                                                            <td>
                                                                <?php $direction_width = ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == '' && $form['numero'] != '' && $form['address'] != '') ? "width:198px" : "width:260px"; ?>
                                                                <?php echo $form['address']->render(array('style' => $direction_width, 'disabled' => "disabled")) ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                                            <?php if (!empty($dataProfesional['numero'])): ?>
                                                                <td><?php echo $form['numero']->render(array('disabled' => "disabled", 'style' => 'width:41px')) ?></td>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <td><?php //echo $form['numero']->render(array('disabled'=>"disabled"))                                                ?></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php if ($dataProfesional['piso'] != '' || $dataProfesional['puerta'] != ''): ?>
                                            <tr>
                                                <td colspan="3">
                                                    <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                                        <tr>
                                                            <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                                                <th width="35%" align="left"><?php //echo image_tag('/images/bulb.png',array('border'=>"0"))                                           ?><?php //echo $form['numero']->renderLabel()                                            ?></th>
                                                            <?php else: ?>
                                                                <?php
                                                                if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
                                                                    $width2 = "35%";
                                                                } else if ($dataProfesional['puerta'] != '' && $dataProfesional['email'] != '' && $dataProfesional['piso'] == '') {
                                                                    $width2 = "25%";
                                                                } else {
                                                                    $width2 = "35%";
                                                                }
                                                                ?>
                                                                <th width="<?php echo $width2; ?>" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['numero']->renderLabel() ?></th>
                                                            <?php endif; ?>

                                                            <?php if ($dataProfesional['piso'] != ''): ?>
                                                                <?php
                                                                if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
                                                                    //echo "<th width='43%'><img src='/images/bulb.png' border='' alt=''/>" . $form['email']->renderLabel() . "</th>";
                                                                }
                                                                ?>
                                                                <th width="<?php echo ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') ? "15%" : "36%"; ?>">
                                                                    <?php
                                                                    echo image_tag('/images/bulb.png', array('border' => "0"));
                                                                    if ($dataProfesional['piso'] != '') {
                                                                        echo $form['piso']->renderLabel();
                                                                    }
                                                                    ?>
                                                                </th>
                                                            <?php endif; ?>
                                                            <?php if ($dataProfesional['puerta'] != ''): ?>
                                                                <?php
                                                                $puerta_width = "28%";
                                                                if ($dataProfesional['piso'] == '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] != '')
                                                                    $puerta_width = "36%";
                                                                else if ($dataProfesional['piso'] == '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] != '')
                                                                    $puerta_width = "25%";
                                                                ?>
                                                                <th width="<?php echo $puerta_width; ?>">
                                                                    <?php echo image_tag('/images/bulb.png', array('border' => "0")) ?>
                                                                    <?php
                                                                    if ($dataProfesional['puerta'] != '') {
                                                                        echo $form['puerta']->renderLabel();
                                                                    }
                                                                    ?>
                                                                </th>
                                                            <?php endif; ?>
                                                            <?php
                                                            if ($dataProfesional['piso'] != '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] == '') {
                                                                echo "<th><img src='/images/bulb.png' border='' alt=''/>" . $form['telefono']->renderLabel() . "</th>";
                                                            } else if ($dataProfesional['piso'] == '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] != '') {
                                                                echo "<th><img src='/images/bulb.png' border='' alt=''/>" . $form['telefono']->renderLabel() . "</th>";
                                                            } else if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
                                                                echo "<th><img src='/images/bulb.png' border='' alt=''/>" . $form['email']->renderLabel() . "</th>";
                                                            } else if ($dataProfesional['piso'] == '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] != '') {
                                                                echo "<th><img src='/images/bulb.png' border='' alt=''/>" . $form['email']->renderLabel() . "</th>";
                                                            } else if ($dataProfesional['piso'] == '') {
                                                                echo "<th>&nbsp;</th>";
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                                                <td><?php //echo $form['numero']->render(array('class' => 'top-input3'))                                           ?></td>
                                                            <?php else: ?>
                                                                <td><?php echo $form['numero']->render(array('disabled' => "disabled", 'style' => 'width:33px')) ?></td>
                                                            <?php endif; ?>

                                                            <?php if ($dataProfesional['piso'] != '') { ?>
                                                                <?php
                                                                if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
//                                        $email_flag = true;
//                                        echo '<td>' . $form['email']->render(array('style' => 'width: 193px;', 'disabled' => "disabled")) . '</td>';
                                                                }
                                                                ?>
                                                                <td>
                                                                    <?php echo $form['piso']->render(array('disabled' => "disabled", 'style' => 'width:34px')); ?>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($dataProfesional['puerta'] != '') { ?>
                                                                <td>
                                                                    <?php echo $form['puerta']->render(array('disabled' => "disabled", 'style' => 'width:33px')); ?>
                                                                </td>
                                                            <?php } ?>
                                                            <?php
                                                            if ($dataProfesional['piso'] != '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] == '') {
                                                                $telephone_flag = true;
                                                                echo '<td>' . $form['telefono']->render(array('style' => 'width:81px', 'disabled' => "disabled")) . '</td>';
                                                            } else if ($dataProfesional['piso'] == '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] != '') {
                                                                $telephone_flag = true;
                                                                echo '<td>' . $form['telefono']->render(array('style' => 'width:82px', 'disabled' => "disabled")) . '</td>';
                                                            } else if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
                                                                $email_flag = true;
                                                                echo '<td>' . $form['email']->render(array('style' => 'width: 185px', 'disabled' => "disabled")) . '</td>';
                                                            } else if ($dataProfesional['piso'] == '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] != '') {
                                                                $email_flag = true;
                                                                echo '<td>' . $form['email']->render(array('style' => 'width: 185px', 'disabled' => "disabled")) . '</td>';
                                                            } else if ($dataProfesional['piso'] == '') {
                                                                echo "<td>&nbsp;</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>


                                        <?php if ($dataProfesional['email'] != '' || $dataProfesional['telefono'] != ''): ?>
                                            <tr>
                                                <td colspan="2">
                                                    <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                                        <tbody>
                                                            <tr>
                                                                <?php if ($dataProfesional['telefono'] != '' && !$telephone_flag): ?><th width="35%" align="left"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['telefono']->renderLabel(); ?><?php endif; ?></th>
                                                                <?php if ($dataProfesional['email'] != '' && !$email_flag): ?><th  width="65%" align="left"> <img src="/images/bulb.png" border="0" alt="" /><?php echo $form['email']->renderLabel(); ?><?php endif; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <?php if ($dataProfesional['telefono'] != '' && !$telephone_flag): ?><td><?php echo $form['telefono']->render(array('style' => 'width:72px', 'disabled' => "disabled")); ?></td><?php endif; ?>
                                                                <?php if ($dataProfesional['email'] != '' && !$email_flag): ?><td><?php echo $form['email']->render(array('style' => 'width:260px', 'disabled' => "disabled")); ?></td><?php endif; ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                                    <tr>
                                                        <th width="35%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['states_id']->renderLabel() ?></th>
                                                        <th width="65%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['city_id']->renderLabel() ?></th>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $form['states_id']->render(array('style' => 'width:92%;')) ?></td>
                                                        <td><?php echo $form['city_id']->render(array('class' => 'top-input1')) ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                                    <tr>
                                                        <td colspan="2"><?php echo $form['name']->renderError() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="24%" align="left"><?php echo image_tag('/images/bulb.png', array('border' => "0")) ?><?php echo $form['name']->renderLabel() ?></th>
                                                        <?php $class = ''; ?>
                                                        <?php if ($form['name']->hasError()): ?>
                                                            <?php $class = 'error'; ?>
                                                        <?php endif; ?>
                                                        <td width="76%"><?php echo $form['name']->render(array('style' => 'width:315px;', 'class' => $class)) ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="border-box ML-5 MR-2">
                                    <div class="top-left">
                                        <div class="top-right">
                                            <h2 style="text-align:center; padding:0px; height:27px; line-height:23px;"><?php echo $form['incidencia']->renderLabel() ?></h2>
                                        </div>
                                    </div>
                                    <div class="bottom-left">
                                        <div class="bottom-right"></div>
                                    </div>
                                </div>
                                <div class="grayBox">
                                    <ul id="Error_max_length_incidencia" class="nextval error_list" style="display:none;">
                                        <li>Has superado el espacio permitido para tu recomendación.</li>
                                    </ul>
                                    <?php echo $form['incidencia']->renderError() ?>
                                    <?php echo $form['incidencia'] ?>
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="margin-bottom:8px; float: left;"><br /><br /><?php echo __('*Datos requeridos.') ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $form["borrador"]->render() ?> <?php echo $form["borrador"]->renderLabel() ?></td>
                                            </tr>
                                            <tr>
                                                <td align="center" colspan="2">
                                                    <input id="prof_submit" class="red_button" name="save" type="submit" value="<?php echo __('envía') ?>"/>
                                                    <?php echo link_to(__('cancela'), "@profesional-cartas-draft" . "#top") ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="bottom"></div>
                <!--div class='block_reset'>
                    <a href='<?php echo url_for('/las-listas/directorio-de-buenos-profesionales') ?>' >vuelve al Directorio</a>
                </div-->
            </div>
            <div class="bottom"></div>
        </div>
    </div>
</div>
<?php if ($form['incidencia']->hasError()): ?>
    <style type="text/css">
        span.cke_skin_kama {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>
<style type="text/css">
    ul.error_list {
        margin: 0 15px 5px 0;
    }
</style>
<script type="text/javascript">
    $('#menu').accordion();
    $("input#prof_submit").click(function(){
        $("input#prof_submit").attr('disabled','disabled');
        $("input#prof_submit").removeClass("red_button");
        $("input#prof_submit").addClass("gray_button");
        
    });
    
    jQuery("#frmProfesionalRecomend").submit(function(e) {

        jQuery("#profesional_first_name").removeAttr("disabled");
        jQuery("#profesional_last_name_one").removeAttr("disabled");
        jQuery("#profesional_last_name_two").removeAttr("disabled");
        jQuery("#profesional_address").removeAttr("disabled");
        jQuery("#profesional_numero").removeAttr("disabled");
        jQuery("#profesional_piso").removeAttr("disabled");
        jQuery("#profesional_puerta").removeAttr("disabled");

    });
    $(document).ready(function() {
        $('#profesional_borrador').bind('click', function(){
            $('#frmProfesionalRecomend').submit();
        }); 
        
    });
</script>