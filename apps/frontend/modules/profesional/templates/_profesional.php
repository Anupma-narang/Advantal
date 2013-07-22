<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<?php if (!isset($tipo))
    $tipo = 'index'; ?>
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>

<?php
$telephone_flag = false;
$email_flag = false;
?>
<div id="content_concurso_activo_small">
    <div class="grayBox" style="margin-bottom:5px;">
        <h2 style="text-align:center; margin:0px; padding:0px; height:auto;">RECOMIENDA UN NUEVO PROFESIONAL</h2>
    </div>
    <div id="" class="grayBox" style="margin-bottom:5px;">
        <table cellpadding="0" cellspacing="0" width="100%" border="0">
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tr>
                            <th valign="middle" width="35%"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['first_name']->renderLabel() ?></th>
                            <th width="65%"><?php echo $form['first_name']->render(array('class' => 'fontDisable', 'disabled' => "disabled")) ?></th>
                        </tr>
                        <tr>
                            <th valign="middle"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['last_name_one']->renderLabel() ?></th>
                            <th><?php echo $form['last_name_one']->render(array('class' => 'fontDisable', 'disabled' => "disabled")) ?></th>
                        </tr>
                        <tr>
                            <th valign="middle"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['last_name_two']->renderLabel() ?></th>
                            <th><?php echo $form['last_name_two']->render(array('class' => 'fontDisable', 'disabled' => "disabled")) ?></th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <th width="35%">
                                    <img src="/images/bulb.png" border="0" alt=""  />
                                    <?php echo $form['profesional_tipo_uno_id']->renderLabel('Sector<br/>profesional*', array('style' => "line-height:15px;")) ?>
                                </th>
                                <td width="65%">
                                    <select disabled="disabled" class="top-select">
                                        <option><?php echo $concurso->getProfesionalTipoUno(); ?></option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tr>
                            <th align="left" width="35%">
                                <img src="/images/bulb.png" border="0" alt="" />
                                <?php echo $form['profesional_tipo_dos_id']->renderLabel('Subsector<br/>profesional*', array('style' => "line-height:15px;")) ?>
                            </th>
                            <td width="65%">
                                <select disabled="disabled" class="top-select">
                                    <option><?php echo $concurso->getProfesionalTipoDos(); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                        <?php if ($concurso->getProfesionalTipoTres() != ''): ?>
                            <tr>
                                <th width="35%" class="paddB5">
                                    <img src="/images/bulb.png" border="0" alt="" />
                                    <?php echo $form['profesional_tipo_tres_id']->renderLabel('Actividad<br/>profesional*', array('style' => "line-height:15px;")) ?>
                                </th>
                                <td width="65%" class="paddB5">
                                    <select disabled="disabled" class="top-select">
                                        <option><?php echo $concurso->getProfesionalTipoTres(); ?></option>
                                    </select>
                                </td>
                            </tr>
                        <?php endif; ?>
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
                            <?php if (!empty($dataProfesional['road_type_id'])): ?>
                                <td>
                                    <select disabled="disabled" class="top-select1" style="width: 72%">
                                        <option><?php echo $concurso->getRoadType(); ?></option>
                                    </select>
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
                                    <td><?php echo $form['numero']->render(array('disabled' => "disabled", 'style' => 'width:40px')) ?></td>
                                <?php endif; ?>
                            <?php else: ?>
                                <td><?php //echo $form['numero']->render(array('disabled'=>"disabled"))                                                   ?></td>
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
                                    <th width="35%" align="left"><?php //echo image_tag('<?php echo image_path('bulb.png'); ?>',array('border'=>"0"))                                                  ?><?php //echo $form['numero']->renderLabel()                                                   ?></th>
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
                                    <td><?php //echo $form['numero']->render(array('class' => 'top-input3'))                                                  ?></td>
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
                                    <?php if ($dataProfesional['telefono'] != '' && !$telephone_flag): ?><td><?php echo $form['telefono']->render(array('style' => 'width:72px', 'disabled' => "disabled")); ?></td><?php endif; ?>
                                    <?php if ($dataProfesional['email'] != '' && !$email_flag): ?><td><?php echo $form['email']->render(array('style' => 'width:260px', 'disabled' => "disabled")); ?></td><?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" width="100%" border="0" class="tableSpace">
                        <tr>
                            <th class="td-width" align="left" width="35%"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['states_id']->renderLabel() ?></th>
                            <th align="left" width="65%"><img src="/images/bulb.png" border="0" alt="" /><?php echo $form['city_id']->renderLabel() ?></th>
                        </tr>
                        <tr>
                            <td>
                                <select disabled="disabled" class="top-select1">
                                    <option><?php echo $concurso->getStates(); ?></option>
                                </select>
                            </td>
                            <td>
                                <select disabled="disabled" class="top-select">
                                    <option><?php echo $concurso->getCity(); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php //echo $form['incidencia']->renderLabel()                                                    ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="grayBox" style="margin-bottom:5px;">
        <h2 style="text-align:center; margin:0px; padding:0px; height:auto;"><?php echo $form['incidencia']->renderLabel() ?></h2>
    </div>
    <div class="grayBox MB5">
        <table cellpadding="0" cellspacing="0" width="100%" border="0">
            <tr>
                <td><?php echo $form['incidencia']->render(array('class' => 'top-input1', 'disabled' => "disabled")); ?></td>
            </tr>
        </table>
    </div>
    <!-- <div id="show_detalle_concurso_bot_small"></div>-->
</div>

<script type="text/javascript">

    $('#menu').accordion();
<?php if ($tipo == 'show'): ?>
        $(document).ready(function() {
            var expand=false;
            $('#Expand_collapse').click(function(){
                if(!expand){
                    $('#box_botoon').css('height','auto');
                    $('#box_botoon').css('min-height', '90px');

                    $(this).css('background-position', '-19px 0');
                    expand=true;
                }
                else{
                    $('#box_botoon').css('height','110px');
                    $(this).css('background-position', '0 0');
                    expand=false;
                };
            });
        });
<?php endif; ?>
</script>