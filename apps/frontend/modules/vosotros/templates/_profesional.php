<?php use_helper('mihelper', 'alternativeLink'); ?>
<div class="item" id="wholeDiv<?php echo $profesional->getId(); ?>" style="cursor:pointer" >
    <div class="col_left">
        <ul class='lista_detalles'>
            <li class="title">
                <?php
                $string = html_entity_decode($profesional->getLastNameOne() . ' ' . $profesional->getLastNameTwo() . ', ' . $profesional->getFirstName());
                list($first, $second, $third, $forth, $fifth, $sixth) = str_split($string, 40);

                $second = isset($second) ? $second : '';

                $single = substr($second, 0, 1);
                if ($single == ',') {
                    $second = substr($second, 1);
                    $first .= ',';
                }

                $second .= (isset($third) ? $third : '');
                $second .= (isset($forth) ? $forth : '');
                $second .= (isset($fifth) ? $fifth : '');
                $second .= (isset($sixth) ? $sixth : '');

                /* if(strlen($profesional->getLastNameOne().' '.$profesional->getLastNameTwo()) > 20)
                  echo $profesional->getLastNameOne().'&nbsp;'.$profesional->getLastNameTwo().'<br>'.$profesional->getFirstName();
                  else
                  echo $profesional->getLastNameOne().'&nbsp;'.$profesional->getLastNameTwo().',&nbsp;'.$profesional->getFirstName(); */
                ?>
                <div class="first_name_string"><?php echo $first; ?></div>
                <div class="second_name_string"><?php echo truncate_text($second, 45, ''); ?></div>
            </li>
            <li style ='color:#585858;'>
                <strong><?php echo $profesional->getDireccionCompleta(); ?>
                    (<a href="#" class="fancybox-media fancybox.iframe"><?php echo htmlentities('C�mo llegar'); ?></a>)
                </strong>
            </li>

            <li class="ciudad"><strong><?php echo truncate_text($profesional->getMunicipioProvincia(), 40, '') ?></strong></li>
            <li class="sector org"><strong><?php echo truncate_text($profesional->getActivityName(), 40, ''); ?></strong></li>
            <li class="categoria_excelencia"> <?php $url = url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())); ?>
                <a title='Indicadores de excelencia' onmouseover="$('#wholeDiv<?php echo $profesional->getId(); ?>').attr('onclick', 'javascript:void(0);');" onmouseout='setUrl(<?php echo $profesional->getId(); ?>, "<?php echo $url ?>");' class='categoria_excelencia'
                   href="<?php echo url_for('lista_profesional_categoria_excelencia', array('tipo' => 'profesionales', 'slug' => $profesional->getSlug())) ?>">
                    Indicadores de excelencia
                </a>
            </li>
        </ul>
    </div>

    <div id="alin_der_img">
        <ul>
            <li>
                <?php echo image_tag('star.png') ?>
                <a href="#"><?php echo htmlentities('a�ade a favoritos'); ?></a>
            </li>
            <?php if (isset($list_type)): ?>
                <span class="hidden" id="desc-<?php echo $profesional->getId(); ?>"><?php echo html_entity_decode($profesional->getDescription()); ?></span>
                <?php if ($list_type == 'recommended'): ?>
                    <a href="javascript:void(0)" class="" onclick="showDesc('Cartas de recomendación', '<?php echo $profesional->getId(); ?>')"><?php echo __('ver recomendaciones'); ?></a>
                <?php else: ?>
                    <a href="javascript:void(0)" class="" onclick="showDesc('Cartas de desaprobación', '<?php echo $profesional->getId(); ?>')"><?php echo __('ver desaprobaciones'); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <li>
                    <?php
                    if ($sf_user->isAuthenticated())
                        echo link_to('recomienda', 'profesionalrecomend/' . $profesional->getId(), array('class' => 'login_required recomienda', 'message' => 'Para <strong>recomendar a un profesional</strong> necesitas ser colaborador.'));
                    else
                        echo authenticated_link_to(
                                $sf_user, "recomienda", 'profesionalrecomend/' . $profesional->getId(), "recomienda", url_for("nosotros_lightboxes/accesocuenta") . "?texto=3&redirect=" . 'profesionalrecomend/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda',
                            "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                            "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'
                                )
                        );
                    ?>
                  <!--	a class="recomienda" href="<?php //echo url_for('profesionalrecomend/'.$profesional->getId(), array('dialog_id' => 'login_required'))       ?>"> recomienda</a>-->
                </li>
                <li>
                    <?php
                    if ($sf_user->isAuthenticated())
                        echo link_to('desaprueba', 'profesionaldisaproval/' . $profesional->getId(), array('class' => 'login_required recomienda', 'message' => 'Para <strong>desaprobar a un profesional</strong> necesitas ser colaborador. '));
                    else
                        echo authenticated_link_to($sf_user, "desaprueba", 'profesionaldisaproval/' . $profesional->getId(), 'desaprueba', url_for("nosotros_lightboxes/accesocuenta") . "?texto=4&redirect=" . 'profesionaldisaproval/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda', "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                            "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'));
                    ?>
                    <!--<a class="recomienda" href="<?php //echo url_for('profesionaldisaproval/'.$profesional->getId(), array('dialog_id' => 'login_required'))       ?>"> desaprueba</a>-->
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>