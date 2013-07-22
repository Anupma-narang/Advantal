<?php use_javascript('ckeditor/ckeditor.js'); ?>
<?php use_javascript('jquery.filestyle.js'); ?>
<!--<form id="frmProfesional" action="<?php //echo url_for('profesional/index') .(!$form->isNew() ? '?id='.$form->getObject()->getId() : '')                                                                                                                                    ?>" method="POST" name="frmProfesional">-->

<?php echo $form->renderFormTag(url_for($sf_params->get('module') . '/' . $sf_params->get('action') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')), array("name" => $form->getName(), "id" => $form->getName(), "method" => "POST")); ?>
<?php if ($form->getObject()->isNew()): ?>
    <?php echo input_hidden_tag('lid', $sf_params->get('lid'), array('readonly' => true)); ?>
<?php endif; ?>
<?php echo $form->renderHiddenFields(); ?>
<?php echo $form->renderGlobalErrors(); ?>
<?php $class = ''; ?>
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
                            <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                <tbody>
                                    <tr>
                                        <th align="left" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['road_type_id']->renderLabel() ?></th>
                                        <th align="left" width="65%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['address']->renderLabel() ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form['road_type_id']->renderError() ?></td>
                                        <td><?php echo $form['address']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <?php $class_road_type = (($form['road_type_id']->hasError()) ? 'error' : ''); ?>
                                        <?php $class_address = (($form['address']->hasError()) ? 'error' : ''); ?>
                                        <td><?php echo $form['road_type_id']->render(array('style' => 'width:85%;', 'class' => 'top-select1 ' . $class_road_type)) ?></td>
                                        <td><?php echo $form['address']->render(array('style' => 'width:260px', 'class' => $class_address)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                <tbody>
                                    <tr>
                                        <th align="left" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['numero']->renderLabel() ?></th>
                                        <th align="left" width="36%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['piso']->renderLabel() ?></th>
                                        <th align="left" width="28%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['puerta']->renderLabel() ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form['numero']->renderError() ?></td>
                                        <td><?php echo $form['piso']->renderError() ?></td>
                                        <td><?php echo $form['puerta']->renderError() ?></td>
                                    <tr>
                                        <?php $class_numero = (($form['numero']->hasError()) ? 'error' : ''); ?>
                                        <?php $class_piso = (($form['piso']->hasError()) ? 'error' : ''); ?>
                                        <?php $class_puerta = (($form['puerta']->hasError()) ? 'error' : ''); ?>
                                        <td><?php echo $form['numero']->render(array('style' => 'width:33px', 'class' => $class_numero)) ?></td>
                                        <td><?php echo $form['piso']->render(array('style' => 'width:24px', 'class' => $class_piso)) ?></td>
                                        <td><?php echo $form['puerta']->render(array('style' => 'width:33px', 'class' => $class_puerta)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                                <tbody>
                                    <tr>
                                        <th class="td-width" width="35%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['telefono']->renderLabel() ?></th>
                                        <th width="65%"><img src="<?php echo image_path('bulb.png'); ?>" border="0" alt="" /><?php echo $form['email']->renderLabel() ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form['telefono']->renderError() ?></td>
                                        <td><?php echo $form['email']->renderError() ?></td>
                                    </tr>
                                    <tr>
                                        <?php $class_telephone = (($form['telefono']->hasError()) ? 'error' : ''); ?>
                                        <td><?php echo $form['telefono']->render(array('style' => 'width:72px', 'class' => $class_telephone)) ?></td>
                                        <?php $class_email = (($form['email']->hasError()) ? 'error' : ''); ?>
                                        <td><?php echo $form['email']->render(array('class' => 'top-input1 ' . $class_email)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
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