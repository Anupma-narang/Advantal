<?php use_javascript('ckeditor/ckeditor.js'); ?>
<?php use_javascript('jquery.filestyle.js'); ?>

<!--<form id="frmProfesional" action="<?php //echo url_for('profesional/index') .(!$form->isNew() ? '?id='.$form->getObject()->getId() : '')                                                                                                                                             ?>" method="POST" name="frmProfesional">-->

<?php echo $form->renderFormTag(url_for($sf_params->get('module') . '/' . $sf_params->get('action') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')), array("name" => $form->getName(), "id" => $form->getName(), "method" => "POST")); ?>
<?php if ($form->getObject()->isNew()): ?>
    <?php echo input_hidden_tag('lid', $sf_params->get('lid'), array('readonly' => true)); ?>
<?php endif; ?>
<?php echo $form->renderHiddenFields(); ?>
<?php echo $form->renderGlobalErrors(); ?>
<?php $class = ''; ?>
<?php
$telephone_flag = false;
$email_flag = false;
?>
<div style="clear: both"></div>
<div>
    <?php $sf_user->hasFlash('notice') ? '<div>' . $sf_user->getFlash('notice') . '</div>' : ''; ?>
</div>
<div class="border-box ML-5">
    <?php if ($sf_user->hasFlash('notice')): ?>
        <div id="Flash" class="flashMsgBox">
            <div class="flash_notice">
                <span class="close"><?php echo link_to_function('', "$('#Flash').hide('slow');$('#hasvotado$eid').show();") ?></span>
                <?php echo $sf_user->getFlash('notice', ESC_RAW) ?>
                <?php echo $sf_user->getFlash('nueva_contribucion', ESC_RAW) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="grayBox ML5">
            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><?php echo $form['first_name']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <th valign="middle" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['first_name']->renderLabel() ?></th>
                                        <?php $class = (($form['first_name']->hasError()) ? 'error' : ''); ?>
                                        <th width="65%"><?php echo $form['first_name']->render(array('class' => 'top-input1 ' . $class)) ?></th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $form['last_name_one']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <th valign="middle"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['last_name_one']->renderLabel() ?></th>
                                        <?php $class_last_name_one = (($form['last_name_one']->hasError()) ? 'error' : ''); ?>
                                        <th><?php echo $form['last_name_one']->render(array('class' => 'top-input1 ' . $class_last_name_one)) ?></th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $form['last_name_two']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <th valign="middle"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['last_name_two']->renderLabel() ?></th>
                                        <?php $class_last_name_two = (($form['last_name_two']->hasError()) ? 'error' : ''); ?>
                                        <th><?php echo $form['last_name_two']->render(array('class' => 'top-input1 ' . $class_last_name_two)) ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <?php if ($form['profesional_tipo_uno_id']->hasError()): ?>
                                    <tr><td colspan="2"><?php echo $form['profesional_tipo_uno_id']->renderError() ?></td></tr>
                                <?php endif; ?>
                                <tr>
                                    <th width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt=""  />
                                        <?php echo $form['profesional_tipo_uno_id']->renderLabel('Sector<br/>profesional*', array('style' => "line-height:15px;")) ?>
                                    </th>
                                    <?php $class_uno = (($form['profesional_tipo_uno_id']->hasError()) ? 'error' : ''); ?>
                                    <td width="65%"><?php echo $form['profesional_tipo_uno_id']->render(array('class' => 'top-select ' . $class_uno)) ?></td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <?php if ($form['profesional_tipo_dos_id']->hasError()): ?>
                                    <tr>
                                        <td colspan="2" class="paddB5"><?php echo $form['profesional_tipo_dos_id']->renderError() ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th align="left" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" />
                                        <?php echo $form['profesional_tipo_dos_id']->renderLabel('Subsector<br/>profesional*', array('style' => "line-height:15px;")) ?>
                                    </th>
                                    <?php $class_dos = (($form['profesional_tipo_dos_id']->hasError()) ? 'error' : ''); ?>
                                    <td width="65%"><?php echo $form['profesional_tipo_dos_id']->render(array('class' => 'top-select ' . $class_dos)) ?></td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <?php if ($form['profesional_tipo_tres_id']->hasError()): ?>
                                    <tr>
                                        <td colspan="2" class="paddB5"><?php echo $form['profesional_tipo_tres_id']->renderError() ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th width="35%"  class="paddB5"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" />
                                        <?php echo $form['profesional_tipo_tres_id']->renderLabel('Actividad<br/>profesional*', array('style' => "line-height:15px;")) ?>
                                    </th>
                                    <?php $class_tres = (($form['profesional_tipo_tres_id']->hasError()) ? 'error' : ''); ?>
                                    <td width="65%"><?php echo $form['profesional_tipo_tres_id']->render(array('class' => 'top-select ' . $class_tres)) ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
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
                                    <td><?php echo $form['road_type_id']->renderError() ?></td>
                                    <td><?php echo $form['address']->renderError() ?></td>
                                    <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                        <?php if (!empty($dataProfesional['numero'])): ?>
                                            <td><?php echo $form['numero']->renderError() ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($dataProfesional['road_type_id'])): ?>
                                        <td>
                                            <?php $class_road_type = (($form['road_type_id']->hasError()) ? 'error' : ''); ?>
                                            <?php echo $form['road_type_id']->render(array('style' => 'width:85%;', 'class' => 'top-select1 ' . $class_road_type)) ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (!empty($dataProfesional['address'])): ?>
                                        <td>
                                            <?php $class_address = (($form['address']->hasError()) ? 'error' : ''); ?>
                                            <?php $direction_width = ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == '' && $form['numero'] != '' && $form['address'] != '') ? "width:198px" : "width:260px"; ?>
                                            <?php echo $form['address']->render(array('style' => $direction_width, 'class' => $class_address)) ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>
                                        <?php if (!empty($dataProfesional['numero'])): ?>
                                            <?php $class_numero = (($form['numero']->hasError()) ? 'error' : ''); ?>
                                            <td><?php echo $form['numero']->render(array('style' => 'width:40px', 'class' => $class_numero)) ?></td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td><?php //echo $form['numero']->render()                                                       ?></td>
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
                                            <th width="35%" align="left"><?php //echo image_tag('<?php echo image_path('bulb.png');     ?>',array('border'=>"0"))                                                  ?><?php //echo $form['numero']->renderLabel()                                                       ?></th>
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
                                                <?php echo $form['puerta']->renderLabel(); ?>
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
                                            <td width="35%" align="left">&nbsp;</td>
                                        <?php else: ?>
                                            <?php if($form['numero']->hasError()): ?>
                                                <td><?php echo $form['numero']->renderError() ?></td>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($dataProfesional['puerta'] != '' && $form['puerta']->hasError()) { ?>
                                            <td><?php echo $form['puerta']->renderError(); ?></td>
                                        <?php } ?>
                                        <?php
                                        if ($dataProfesional['piso'] != '' && $dataProfesional['telefono'] == '' && $dataProfesional['puerta'] == '' && $form['telefono']->hasError()) {
                                            echo "<td>".$form['telefono']->renderError() . "</td>";
                                        } else if ($dataProfesional['piso'] == '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] != '' && $form['telefono']->hasError()) {
                                            echo "<td>".$form['telefono']->renderError() . "</td>";
                                        } else if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '' && $form['telefono']->hasError()) {
                                            echo "<td>".$form['email']->renderError() . "</td>";
                                        } else if ($dataProfesional['piso'] == '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] != '' && $form['telefono']->hasError()) {
                                            echo "<td>".$form['email']->renderError() . "</td>";
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php if ($dataProfesional['piso'] == '' && $dataProfesional['puerta'] == ''): ?>

                                        <?php else: ?>
                                            <td><?php echo $form['numero']->render(array('style' => 'width:33px')) ?></td>
                                        <?php endif; ?>

                                        <?php if ($dataProfesional['piso'] != '') { ?>
                                            <td>
                                                <?php echo $form['piso']->render(array('style' => 'width:34px')); ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($dataProfesional['puerta'] != '') { ?>
                                            <td>
                                                <?php echo $form['puerta']->render(array('style' => 'width:33px')); ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        if ($dataProfesional['piso'] != '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] == '') {
                                            $telephone_flag = true;
                                            echo '<td>' . $form['telefono']->render(array('style' => 'width:81px')) . '</td>';
                                        } else if ($dataProfesional['piso'] == '' && $dataProfesional['telefono'] != '' && $dataProfesional['puerta'] != '') {
                                            $telephone_flag = true;
                                            echo '<td>' . $form['telefono']->render(array('style' => 'width:82px')) . '</td>';
                                        } else if ($dataProfesional['piso'] != '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] == '') {
                                            $email_flag = true;
                                            echo '<td>' . $form['email']->render(array('style' => 'width: 185px')) . '</td>';
                                        } else if ($dataProfesional['piso'] == '' && $dataProfesional['email'] != '' && $dataProfesional['puerta'] != '') {
                                            $email_flag = true;
                                            echo '<td>' . $form['email']->render(array('style' => 'width: 185px')) . '</td>';
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <!-- this is for telephone and email -->
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
                                            <td><?php echo $form['telefono']->renderError() ?></td>
                                            <td><?php echo $form['email']->renderError() ?></td>
                                        </tr>
                                        <tr>
                                            <?php if ($dataProfesional['telefono'] != '' && !$telephone_flag): ?><td><?php echo $form['telefono']->render(array('style' => 'width:72px')); ?></td><?php endif; ?>
                                            <?php if ($dataProfesional['email'] != '' && !$email_flag): ?><td><?php echo $form['email']->render(array('style' => 'width:260px')); ?></td><?php endif; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                <tbody>
                                    <tr>
                                        <th class="td-width" align="left" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['states_id']->renderLabel() ?></th>
                                        <th align="left" width="65%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['city_id']->renderLabel() ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form['states_id']->renderError() ?></td>
                                        <td><?php echo $form['city_id']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <?php $class_states = (($form['states_id']->hasError()) ? 'error' : ''); ?>
                                        <td style="width: 155px;"><?php echo $form['states_id']->render(array('class' => 'top-select1' . ' ' . $class_states, 'style' => 'width:98%;')) ?></td>
                                        <?php $class_city = (($form['city_id']->hasError()) ? 'error' : ''); ?>
                                        <td><?php echo $form['city_id']->render(array('class' => 'top-select' . ' ' . $class_city)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border-box MR-2">
            <div class="top-left">
                <div class="top-right">
                    <h2 style="text-align:center; padding:6px 10px 5px 5px; height:20px"><?php echo $form['incidencia']->renderLabel() ?></h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <div class="grayBox ML5 MB5">
            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                <tr>
                    <td colspan="2" id="incidencia">
                        <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
                            <li>Has superado el espacio permitido para tu recomendación.</li>
                        </ul>
                        <?php echo $form['incidencia']->renderError() ?>
                        <?php echo $form['incidencia']->render() ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="margin-bottom:8px; float: left;"><br /><br /><?php echo __('*Datos requeridos.') ?></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $form["borrador"]->render() ?> <?php echo $form["borrador"]->renderLabel() ?></td>
                </tr>
                <tr>
                    <td colspan="2"><?php if (!$form->getObject()->isNew()): ?>
                        <?php endif; ?>
                        <?php echo $form->renderGlobalErrors() ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><?php echo $form->renderHiddenFields() ?>
                        <input id="prof_submit" class="red_button" name="save" type="submit" value="<?php echo __('envía') ?>"/>
                        <?php
                        if ($sf_request->getReferer() != "" && $sf_request->getReferer() != 'directorio/index' && $sf_request->getReferer() != $sf_request->getUri())
                            echo link_to(__('cancela'), $sf_request->getReferer() . "#top");
                        elseif (sfContext::getInstance()->getActionName() == 'edit')
                            echo link_to(__('cancela'), "@profesional-draft" . "#top");
                        else
                            echo link_to(__('cancela'), "directorio/index#top");
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<?php endif; ?>
</form>
<?php if ($form['incidencia']->hasError()): ?>
    <style type="text/css">
        span.cke_skin_kama {
            border: 2px solid red;
        }
    </style>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("profesional_states_id");
        $("#profesional_borrador").attr("checked", false);
        $('#profesional_borrador').bind('click', function(){
            $('#profesional').submit();
        });

        $("input#prof_submit").click(function(){
            $("input#prof_submit").attr('disabled','disabled');
            $("input#prof_submit").removeClass("red_button");
            $("input#prof_submit").addClass("gray_button");

        });

        $("#profesional").bind("submit",function(){
            $("#profesional_city_id").removeAttr("disabled");
        });
    });
</script>