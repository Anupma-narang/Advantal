<?php use_stylesheet('global.css') ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php //use_javascript('ckeditor/ckeditor.js');              ?>
<?php echo include_partial('nosotros/miga', array("op" => $op, 'nombreSeccion' => 'contrátanos', 'tituloSeccion' => 'contrátanos')) ?>
<h1><?php echo __('Contrátanos') ?></h1>
<div id="content_concursos_nuevo">
    <form action="<?php echo url_for('nosotros/contratanos') ?>" id="form_"  method="POST" <?php $contratanosForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php echo $contratanosForm->renderHiddenFields(); ?>
        <?php /* if (!$op): ?>
          <div style="clear: botd"></div>
          <div class="border-box">
          <div class="header-left">
          <div class="header-right"></div>
          </div>
          <div class="top-left">
          <div class="top-right">
          <h2 style="clear: botd"><?php echo __('SI ERES UNA EMPRESA, ENTIDAD O FABRICANTE'); ?></h2>
          </div>
          </div>
          <div class="bottom-left">
          <div class="bottom-right"></div>
          </div>
          </div>
          <?php endif; */ ?>

        <?php if ($sf_user->hasFlash('errorContra')): ?>
        <ul class="error_list">
            <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorContra', ESC_RAW) ?></li>
        </ul>
    <?php endif; ?>

        <div class="border-box">
            <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                <div class="top-right">

                    <table style="widtd: 100%">

                        <tr>
                            <td align="left" colspan="2">
                                <label class="bundle">Eres:</label>
                                <div style="float: right">
                                    <select name="select" onchange="document.getElementById('envia').value='0';document.forms['form_'].submit();" class="contratanos_select_box" style="font-size: 15px;">
                                        <option value="0" selected="selected"> Selecciona qué eres </option>
                                        <option value="1" <?php if ($op == 1) { ?>selected="true"<?php } ?>>Soy una empresa, entidad o fabricante</option>
                                        <option value="2" <?php if ($op == 2) { ?>selected="true"<?php } ?>>Soy un profesional</option>
                                    </select>
                                </div>
                                <input type="hidden" id="envia" name="envia" value="1" />
                            </td>
                        </tr>
                        <?php if ($op == 1): ?>
                            <tr>
                                <td><?php echo $contratanosForm['name']->renderError() ?></td>
                                <td><?php echo $contratanosForm['actividad']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['name']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['actividad']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                 <?php
                                $nameError = '';
                                if ($contratanosForm['name']->hasError()) {
                                    $nameError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $actividadError = '';
                                if ($contratanosForm['actividad']->hasError()) {
                                    $actividadError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $contratanosForm['name']->render(array('class' => 'tamano_32_c '.$nameError)) ?></td>
                                <td><?php echo $contratanosForm['actividad']->render(array('class' => 'tamano_32_c '.$actividadError)); ?></td>
                            </tr>
                            <tr>

                                <td><?php echo $contratanosForm['cargo']->renderError() ?></td>
                                <td><?php echo $contratanosForm['nombre']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['cargo']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['nombre']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                $cargoError = '';
                                if ($contratanosForm['cargo']->hasError()) {
                                    $cargoError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $nombreError = '';
                                if ($contratanosForm['nombre']->hasError()) {
                                    $nombreError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $contratanosForm['cargo']->render(array('class' => 'tamano_32_c '.$cargoError)) ?></td>
                                <td><?php echo $contratanosForm['nombre']->render(array('class' => 'tamano_32_c '.$nombreError)); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['apellido1']->renderError() ?></td>
                                <td><?php echo $contratanosForm['apellido2']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['apellido1']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['apellido2']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                 <?php
                                $apellido1Error = '';
                                if ($contratanosForm['apellido1']->hasError()) {
                                    $apellido1Error = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $apellido2Error = '';
                                if ($contratanosForm['apellido2']->hasError()) {
                                    $apellido2Error = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $contratanosForm['apellido1']->render(array('class' => 'tamano_32_c '.$apellido1Error)) ?></td>
                                <td><?php echo $contratanosForm['apellido2']->render(array('class' => 'tamano_32_c '.$apellido2Error)); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['phone']->renderError() ?></td>
                                <td><?php echo $contratanosForm['email']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['phone']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['email']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                $phoneError = '';
                                if ($contratanosForm['phone']->hasError()) {
                                    $phoneError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $emailError = '';
                                if ($contratanosForm['email']->hasError()) {
                                    $emailError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $contratanosForm['phone']->render(array('class' => 'tamano_9_c '.$phoneError)) ?></td>
                                <td><?php echo $contratanosForm['email']->render(array('class' => 'tamano_32_c '.$emailError)); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['road_type_id']->renderError() ?></td>
                                <td><?php echo $contratanosForm['direccion']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['road_type_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['direccion']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                $road_type_idError = '';
                                if ($contratanosForm['road_type_id']->hasError()) {
                                    $road_type_idError = 'errorInviteFrm';
                                }
                                ?>
                                <?php
                                $direccionError = '';
                                if ($contratanosForm['direccion']->hasError()) {
                                    $direccionError = 'errorInviteFrm';
                                }
                                ?>
                                <td><?php echo $contratanosForm['road_type_id']->render(array($road_type_idError)) ?></td>
                                <td><?php echo $contratanosForm['direccion']->render(array('class' => 'tamano_32_c '.$direccionError)); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $contratanosForm['num']->renderError() ?>
                                    <?php echo $contratanosForm['piso']->renderError() ?>
                                    <?php echo $contratanosForm['puerta']->renderError() ?>
                                </td>
                                <td>
                                    <?php echo $contratanosForm['cp']->renderError(); ?>
                                    <?php echo $contratanosForm['cif']->renderError(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="30%"><?php echo $contratanosForm['num']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                            <td width="30%"><?php echo $contratanosForm['piso']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                            <td width="40%"><?php echo $contratanosForm['puerta']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="50%"><?php echo $contratanosForm['cp']->renderLabel(null, array('class' => 'bundle ')) ?></td>
                                            <td width="50%"><?php echo $contratanosForm['cif']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <?php
                                                $numError = '';
                                                if ($contratanosForm['num']->hasError()) {
                                                $numError = 'errorInviteFrm';
                                                }
                                            ?>
                                            <?php
                                                $pisoError = '';
                                                if ($contratanosForm['piso']->hasError()) {
                                                $pisoError = 'errorInviteFrm';
                                                }
                                            ?>
                                            <?php
                                                $puertaError = '';
                                                if ($contratanosForm['puerta']->hasError()) {
                                                $puertaError = 'errorInviteFrm';
                                                }
                                            ?>
                                            <td width="30%"><?php echo $contratanosForm['num']->render(array('class' => 'tamano_4_c '.$numError)) ?></td>
                                            <td width="30%"><?php echo $contratanosForm['piso']->render(array('class' => 'tamano_2_c '.$pisoError)) ?></td>
                                            <td width="40%"><?php echo $contratanosForm['puerta']->render(array('class' => 'tamano_4_c '.$puertaError)) ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <?php
                                                $cpError = '';
                                                if ($contratanosForm['cp']->hasError()) {
                                                $cpError = 'errorInviteFrm';
                                                }
                                            ?>
                                            <?php
                                                $cifError = '';
                                                if ($contratanosForm['cif']->hasError()) {
                                                $cifError = 'errorInviteFrm';
                                                }
                                            ?>
                                            <td width="50%"><?php echo $contratanosForm['cp']->render(array('class' => 'tamano_5_c '.$cpError)); ?></td>
                                            <td width="50%"><?php echo $contratanosForm['cif']->render(array('class' => 'tamano_9_c '.$cifError)); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['states_id']->renderError() ?></td>
                                <td><?php echo $contratanosForm['city_id']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['states_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['city_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                        $states_idError = '';
                                        if ($contratanosForm['states_id']->hasError()) {
                                       $states_idError = 'errorInviteFrm';
                                           }
                                ?>
                                <?php
                                      $city_idError = '';
                                      if ($contratanosForm['city_id']->hasError()) {
                                      $city_idError = 'errorInviteFrm';
                                      }
                                 ?>
                                <td><?php echo $contratanosForm['states_id']->render(array('class' => $states_idError)) ?></td>
                                <td><?php echo $contratanosForm['city_id']->render(array('class' => $city_idError)); ?></td>
                            </tr>

                        <?php elseif ($op == 2): ?>
                            <!-- professionals -->
                            <?php if ($eres != 2): ?>
                                <input type="hidden" name="prof_eres" id="prof_eres" value="0" />
                                <tr>
                                    <td><?php echo $contratanosForm['eres']->renderError() ?></td>
                                    <td id="row1"><?php echo $contratanosForm['nombre']->renderError(); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $contratanosForm['eres']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                    <td id="row2"><?php echo $contratanosForm['nombre']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                </tr>
                                <tr>
                                    <?php
                                        $eresError = '';
                                        if ($contratanosForm['eres']->hasError()) {
                                       $eresError = 'errorInviteFrm';
                                           }
                                ?>
                                <?php
                                      $nombreError = '';
                                      if ($contratanosForm['nombre']->hasError()) {
                                      $nombreError = 'errorInviteFrm';
                                      }
                                 ?>
                                    <td><?php echo $contratanosForm['eres']->render(array('class' => $eresError)) ?></td>
                                    <td id="row3"><?php echo $contratanosForm['nombre']->render(array('class' => 'tamano_32_c '.$nombreError)); ?></td>
                                </tr>
                                <tr class="hidden company">
                                    <td><?php echo $contratanosForm['empresa']->renderError() ?></td>
                                    <td id="row4"></td>
                                </tr>
                                <tr class="hidden company">
                                    <td><?php echo $contratanosForm['empresa']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                    <td id="row5"></td>
                                </tr>
                                <tr class="hidden company">
                                    <?php
                                      $empresaError = '';
                                      if ($contratanosForm['empresa']->hasError()) {
                                      $empresaError = 'errorInviteFrm';
                                      }
                                 ?>
                                    <td><?php echo $contratanosForm['empresa']->render(array('class' => 'tamano_32_c '.$empresaError)) ?></td>
                                    <td id="row6"></td>
                                </tr>
                            <?php else: ?>
                                <input type="hidden" name="prof_eres" id="prof_eres" value="2" />
                                <tr>
                                    <td><?php echo $contratanosForm['eres']->renderError() ?></td>
                                    <td id="row1"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $contratanosForm['eres']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                    <td id="row2"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $contratanosForm['eres']->render() ?></td>
                                    <td id="row3"></td>
                                </tr>
                                <tr class="company">
                                    <td><?php echo $contratanosForm['empresa']->renderError() ?></td>
                                    <td id="row4"><?php echo $contratanosForm['nombre']->renderError(); ?></td>
                                </tr>
                                <tr class="company">
                                    <td><?php echo $contratanosForm['empresa']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                    <td id="row5"><?php echo $contratanosForm['nombre']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                </tr>
                                <tr class="company">
                                    <td><?php echo $contratanosForm['empresa']->render() ?></td>
                                    <td id="row6"><?php echo $contratanosForm['nombre']->render(); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>

                                <td><?php echo $contratanosForm['apellido1']->renderError() ?></td>
                                <td><?php echo $contratanosForm['apellido2']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['apellido1']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['apellido2']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                      $apellido1Error = '';
                                      if ($contratanosForm['apellido1']->hasError()) {
                                      $apellido1Error = 'errorInviteFrm';
                                         }
                                ?>
                                <?php
                                      $apellido2Error = '';
                                      if ($contratanosForm['apellido2']->hasError()) {
                                      $apellido2Error = 'errorInviteFrm';
                                      }
                                 ?>
                                <td><?php echo $contratanosForm['apellido1']->render(array('class' => 'tamano_32_c '.$apellido1Error)) ?></td>
                                <td><?php echo $contratanosForm['apellido2']->render(array('class' => 'tamano_32_c '.$apellido2Error)); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['actividad']->renderError() ?></td>
                                <td><?php echo $contratanosForm['cargo']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><label for="contratanos_actividad" class="bundle">Actividad a la que te dedicas*</label></td>
                                <td><?php echo $contratanosForm['cargo']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                      $actividadError = '';
                                      if ($contratanosForm['actividad']->hasError()) {
                                      $actividadError = 'errorInviteFrm';
                                        }
                                ?>
                                <?php
                                      $cargoError = '';
                                      if ($contratanosForm['cargo']->hasError()) {
                                      $cargoError = 'errorInviteFrm';
                                      }
                                 ?>
                                <td><?php echo $contratanosForm['actividad']->render(array('class' => 'tamano_32_c '.$actividadError)) ?></td>
                                <td><?php echo $contratanosForm['cargo']->render(array('class' => 'tamano_32_c '.$cargoError)); ?></td>
                            </tr>
                            <tr>

                                <td><?php echo $contratanosForm['road_type_id']->renderError() ?></td>
                                <td><?php echo $contratanosForm['direccion']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['road_type_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['direccion']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                      $road_type_idError = '';
                                      if ($contratanosForm['road_type_id']->hasError()) {
                                      $road_type_idError = 'errorInviteFrm';
                                        }
                                ?>
                                <?php
                                      $direccionError = '';
                                      if ($contratanosForm['direccion']->hasError()) {
                                      $direccionError = 'errorInviteFrm';
                                      }
                                 ?>
                                <td><?php echo $contratanosForm['road_type_id']->render(array('class' => $road_type_idError)) ?></td>
                                <td><?php echo $contratanosForm['direccion']->render(array('class' => 'tamano_32_c '.$direccionError)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="30%"><?php echo $contratanosForm['num']->renderError() ?></td>
                                            <td width="30%"><?php echo $contratanosForm['piso']->renderError() ?></td>
                                            <td width="40%"><?php echo $contratanosForm['puerta']->renderError() ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="50%"><?php echo $contratanosForm['cp']->renderError(); ?></td>
                                            <td width="50%"><?php echo $contratanosForm['cif']->renderError(); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="30%"><?php echo $contratanosForm['num']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                            <td width="30%"><?php echo $contratanosForm['piso']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                            <td width="40%"><?php echo $contratanosForm['puerta']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <td width="50%"><?php echo $contratanosForm['cp']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                            <td width="50%"><?php echo $contratanosForm['cif']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <?php
                                                 $numError = '';
                                                 if ($contratanosForm['num']->hasError()) {
                                                 $numError = 'errorInviteFrm';
                                                 }
                                            ?>
                                            <?php
                                                 $pisoError = '';
                                                 if ($contratanosForm['piso']->hasError()) {
                                                 $pisoError = 'errorInviteFrm';
                                                 }
                                            ?>
                                            <?php
                                                 $puertaError = '';
                                                 if ($contratanosForm['puerta']->hasError()) {
                                                 $puertaError = 'errorInviteFrm';
                                                 }
                                             ?>
                                            <td width="30%"><?php echo $contratanosForm['num']->render(array('class' => 'tamano_4_c '.$numError)) ?></td>
                                            <td width="30%"><?php echo $contratanosForm['piso']->render(array('class' => 'tamano_2_c '.$pisoError)) ?></td>
                                            <td width="40%"><?php echo $contratanosForm['puerta']->render(array('class' => 'tamano_4_c '.$puertaError)) ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table cellpadding="0" cellspacing ="0">
                                        <tr>
                                            <?php
                                                 $cpError = '';
                                                 if ($contratanosForm['cp']->hasError()) {
                                                 $cpError = 'errorInviteFrm';
                                                 }
                                            ?>
                                            <?php
                                                 $cifError = '';
                                                 if ($contratanosForm['cif']->hasError()) {
                                                 $cifError = 'errorInviteFrm';
                                                 }
                                             ?>
                                            <td width="50%"><?php echo $contratanosForm['cp']->render(array('class' => 'tamano_5_c '.$cpError)); ?></td>
                                            <td width="50%"><?php echo $contratanosForm['cif']->render(array('class' => 'tamano_9_c '.$cifError)); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['phone']->renderError() ?></td>
                                <td><?php echo $contratanosForm['email']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['phone']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['email']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                             <?php
                                                 $phoneError = '';
                                                 if ($contratanosForm['phone']->hasError()) {
                                                 $phoneError = 'errorInviteFrm';
                                                 }
                                            ?>
                                            <?php
                                                 $emailError = '';
                                                 if ($contratanosForm['email']->hasError()) {
                                                 $emailError = 'errorInviteFrm';
                                                 }
                                             ?>
                                <td><?php echo $contratanosForm['phone']->render(array('class' => 'tamano_9_c '.$phoneError)) ?></td>
                                <td><?php echo $contratanosForm['email']->render(array('class' => 'tamano_32_c '.$emailError)); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['states_id']->renderError() ?></td>
                                <td><?php echo $contratanosForm['city_id']->renderError(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $contratanosForm['states_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                                <td><?php echo $contratanosForm['city_id']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                            <?php
                                                 $states_idError = '';
                                                 if ($contratanosForm['states_id']->hasError()) {
                                                 $states_idError = 'errorInviteFrm';
                                                 }
                                            ?>
                                            <?php
                                                 $city_idError = '';
                                                 if ($contratanosForm['city_id']->hasError()) {
                                                 $city_idError = 'errorInviteFrm';
                                                 }
                                             ?>
                                <td><?php echo $contratanosForm['states_id']->render(array('class' => $states_idError)) ?></td>
                                <td><?php echo $contratanosForm['city_id']->render(array('class' => $city_idError)); ?></td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
        <?php if ($op): ?>
            <div style="clear: botd"></div>
            <div class="border-box">
                <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                    <div class="top-right">
                        <h2 style="clear: botd"><?php echo __('PARA MEJORAR TU PRODUCTO O SERVICIO'); ?></h2>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

            <div class="border-box">
                <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
                    <div class="top-right">

                        <table style="widtd: 100%">
                            <tr>
                                <td colspan="2"><?php echo $contratanosForm['ayudar']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <ul id="error_max_length" class="error_list" style="display:none">
                                        <li>Has superado el límite para tu comentario.</li>
                                    </ul>
                                    <?php echo $contratanosForm['ayudar']->renderError() ?>
                                </td>
                            </tr>
                            <tr>
                                <?php if ($contratanosForm['ayudar']->hasError()): ?>
                            <style type="text/css">
                                span.cke_skin_kama {
                                    border: 2px solid red;
                                }
                            </style>
                        <?php endif; ?>
                                <td colspan="2"><?php echo $contratanosForm['ayudar']->render() ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $contratanosForm['servicio']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                        $servicioError = '';
                                        if ($contratanosForm['servicio']->hasError()) {
                                        $servicioError = 'errorInviteFrm';
                                        }
                                 ?>
                                <td colspan="2"><?php echo $contratanosForm['servicio']->render(array('class' => 'tamano_70_c '.$servicioError)) ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $contratanosForm['servicio']->renderError() ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="contratanos_antes"><?php echo $contratanosForm['antes']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr>
                                <?php
                                        $antesError = '';
                                        if ($contratanosForm['antes']->hasError()) {
                                        $antesError = 'errorInviteFrm';
                                        }
                                 ?>
                                <td colspan="2"><?php echo $contratanosForm['antes']->render(array('class' => $antesError)) ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $contratanosForm['antes']->renderError() ?></td>
                            </tr>
                            <tr class="hidden what">
                                <td colspan="2"><?php echo $contratanosForm['what']->renderLabel(null, array('class' => 'bundle')) ?></td>
                            </tr>
                            <tr class="hidden what">
                                <td colspan="2"><?php echo $contratanosForm['what']->render() ?></td>
                            </tr>
                            <tr class="hidden what">
                                <td colspan="2"><?php echo $contratanosForm['what']->renderError() ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong><?php echo __('*Datos requeridos') ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input class="red_button" id="enviarcon" type="submit" value="<?php echo __('envía') ?>"/>
                                    <?php echo link_to('cancela', url_for('nosotros/empresa'), array('Title' => 'cancela')); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        <?php endif; ?>

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
<style type="text/css">
    .contratanos_antes label{
        background: url("../../images/img_nosotros/circulo-lista-2.png") no-repeat scroll left 5px transparent;
        float: left;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("contratanos_states_id");

        $("#user_messagebox").fancybox({padding: 5});
        $("#Not_authenticated").fancybox({padding: 0});

        if(<?php echo $sf_user->hasFlash('contratanos') ? 1 : 0 ?>){
            $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('contratanos')) ?>');
            $("#user_messagebox").trigger('click');
        }

        $("#contratanos_states_id").change(function(){ ceuta_melilla($(this),$("#contratanos_city_id")) });
        $("#newContratanosForm").bind("submit",function(){$("#contratanos_city_id").removeAttr("disabled");});
        $("form").bind("submit",function(){$("#contratanos_city_id").removeAttr("disabled");});
        ceuta_melilla($("#contratanos_states_id"),$("#contratanos_city_id"));
        $('#concurso_borrador').bind('click', function(){
            $('#newContratanosForm').submit();
        });
    });

    function ceuta_melilla(f,g){
        var state2city = new Array();
<?php
foreach (StatesTable::getCiudadesAutonomas() as $city) {
    printf('state2city[%d]=%d;', $city['states_id'], $city['id']);
}
?>
        if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        showBefore();
        $('#contratanos_antes').bind('change', function(){
            showBefore();
        });

        $('#contratanos_eres').bind('change', function(){
            if($(this).val() == 2){
                $('.company').removeClass('hidden');
                if($("#prof_eres").val()!=2){
                    $("#prof_eres").val(2);
                    $("#row4").html($("#row1").html());
                    $("#row5").html($("#row2").html());
                    $("#row6").html($("#row3").html());

                    $("#row1").html("");
                    $("#row2").html("");
                    $("#row3").html("");
                }
            } else {
                $('.company').addClass('hidden');
                if($("#prof_eres").val()==2){
                    $("#prof_eres").val(0);
                    $("#row1").html($("#row4").html());
                    $("#row2").html($("#row5").html());
                    $("#row3").html($("#row6").html());

                    $("#row4").html("");
                    $("#row5").html("");
                    $("#row6").html("");
                }
            }
        });

        /* $('.border-box:eq(2) .top-right table tr:eq(0) td').append('<div id="error_max_length" class="error_max" style="display:none;"><ul class="error_list"><li>Has superado el límite para tu comentario.</li></ul></div>');
        if($('.border-box:eq(2) .top-right table tr:eq(1) ul').hasClass("error_list")){
            $('.border-box:eq(2) .top-right table tr:eq(0) td #error_max_length ').remove();
        } */
    });
    function showBefore(){
        if($('#contratanos_antes').val() == 1){
            $('.what').removeClass('hidden');
        }else{
            $('.what').addClass('hidden');
        }
    }
     $("#enviarcon").click(function() {
                $('#recomienda_emails option').attr("selected", "selected");
                $(this).removeClass("red_button");
                $(this).addClass("gray_button");
                $(this).attr('disabled', 'disabled');
                $('#form_').submit();
            });
</script>
<style type="text/css">
    input.errorInviteFrm{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>
<style type="text/css">
    select.errorInviteFrm{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>