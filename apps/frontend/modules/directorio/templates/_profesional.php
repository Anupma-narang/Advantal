<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php use_helper('mihelper', 'alternativeLink'); ?>
<div class="item_detail_2">
    <div class="item_detail_top"></div>
    <div class="item_detail_middle">
        <div class="item profesional">
            <!--span class="rss" title="Añade profesionales recomendados a RSS"></span-->
            <div class="col_left">
                <ul class='lista_detalles_profeshanel'>
                    <a class="pr_detail" href="<?php echo url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())) ?>">
                        <li class="head">
                            <?php $string = html_entity_decode($profesional->getLastNameOne() . ' ' . $profesional->getLastNameTwo() . ', ' . $profesional->getFirstName()); ?>
                            <?php //echo
                            $string = trim($string);
                            $string = (strlen($string) > 135) ? substr($string, 0, 135) . "..." : $string;
                            echo $string;
                            ?>
                        </li>
                    </a>

                    <?php $dir = $profesional->getRoadType() . ' ' . $profesional->getAddress(); ?>
                    <?php $dir .= ( $profesional->getNumero()) ? ', ' . $profesional->getNumero() : ""; ?>
                    <?php $dir = trim($dir); ?>
                    <?php
                    if (strlen($dir) > 30 && $profesional->getStates() != 'Toda España'):
                        echo '<li title="' . $dir . '">';
                        echo '<a class="pr_detail" href="' . url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())) . '" style="color: #4D5357"><div class="addr" style="width: 250px; float: left">' . $dir . '</div></a>';
                        echo '<div style="width: auto; float: left">(<a title="Cómo llegar al profesional recomendado" class="pr_map fancybox-media fancybox.iframe" href="' . url_for('show_profesional_map', array('slug' => $profesional->getSlug())) . '" style="color: #4D5357">Cómo llegar</a>)</div>';
                        echo '</li>';
                    elseif ($profesional->getStates() != 'Toda España'):
                        echo '<li class="adre" title="' . $dir . '">';
                        echo '<a class="pr_detail" href="' . url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())) . '" style="color: #4D5357"><div class="addr" style="float: left">' . $dir . '</div></a>';
                        echo '<div style="float: left">&nbsp;(<a title="Cómo llegar al profesional recomendado" class="pr_map fancybox-media fancybox.iframe" href="' . url_for('show_profesional_map', array('slug' => $profesional->getSlug())) . '" style="color: #4D5357">Cómo llegar</a>)</div>';
                        echo '</li>';
                    else:
                        echo '<li class="adre" title="' . $dir . '">';
                        echo '<a class="pr_detail" href="' . url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())) . '" style="color: #4D5357">' . $dir . '</a>';
                        echo '</li>';
                    endif;
                    ?>

                    <a class="pr_detail" href="<?php echo url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())) ?>">
                        <li class="ciu_grn" title="<?php echo $profesional->getMunicipioProvincia(); ?>"><?php echo $profesional->getMunicipioProvincia() ?></li>
                        <li class="sect_org" title="<?php echo $profesional->getActivityName(); ?>"><?php echo $profesional->getActivityName(); ?></li>
                    </a>
                    <li class="categoria_excelencia"> <?php $url = url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())); ?>
                        <div style="float: left; width:182px;">
                            <a title='Indicadores de excelencia' onmouseover="$('#wholeDiv<?php echo $profesional->getId(); ?>').attr('onclick', 'javascript:void(0);');" onmouseout='setUrl(<?php echo $profesional->getId(); ?>, "<?php echo $url ?>" );' class='categoria_excelencia'
                               href="<?php echo url_for('lista_profesional_categoria_excelencia', array('tipo' => 'profesionales', 'slug' => $profesional->getSlug())) ?>">
                                Indicadores de excelencia
                            </a>

                            <?php echo image_tag('star.png', array('class' => 'fav-img')) ?>
                            <a style="color: #006600;" class="favourit anadir_favoriros" href="#" title="Añade un profesional recomendado a Favoritos">añade a favoritos</a>
                        </div>
                        <div style="float: left; width:145px;">
                            <?php if ($isRecomendation): ?>
                                <a class="iconRecoDesp categoria_excelencia" title="Cartas de recomendación" href="<?php echo url_for('get_recomendation', array('slug' => $profesional->getSlug())) ?>" style="margin: 3px 3px 0"><img src="/images/icon_reco.png" alt=""></a><span style="color: #FF1919;float: left;margin-top: 7px; clear: none; width: auto;"><strong>(<?php echo $isRecomendation; ?>)</strong></span>
                            <?php endif; ?>

                            <?php if ($isDescription): ?>
                                <a class="iconRecoDesp categoria_excelencia" title="Cartas de desaprobación" href="<?php echo url_for('get_disaproval', array('slug' => $profesional->getSlug())) ?>" style="margin: 3px 3px 0"><img src="/images/icon_desp.png" alt=""></a><span style="color: #FF1919;float: left;margin-top: 7px; clear: none; width: auto;"><strong>(<?php echo $isDescription; ?>)</strong></span>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
            <!--span class="rss" title="Añade empresas y entidades no recomendadas a RSS"></span-->
            <div id="alin_der_img" style="float: left; width: 116px; text-align: center;">
                <ul>
                    <li>
                        <?php
                        if ($sf_user->isAuthenticated())
                            echo link_to('recomienda', 'profesionalrecomend/' . $profesional->getId(), array('style' => 'padding-left:0px;padding-right:0px;', 'title' => 'Recomienda a un profesional', 'class' => 'login_required recomienda', 'message' => 'Para <strong>recomendar a un profesional</strong> necesitas ser colaborador.'));
                        else
                            echo authenticated_link_to(
                                    $sf_user, "recomienda", 'profesionalrecomend/' . $profesional->getId(), "recomienda", url_for("nosotros_lightboxes/accesocuenta") . "?texto=3&redirect=" . 'profesionalrecomend/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda',
                                "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                                "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'
                                    )
                            );
                        ?>
                        <!--	a class="recomienda" href="<?php //echo url_for('profesionalrecomend/'.$profesional->getId(), array('dialog_id' => 'login_required'))                                                                                      ?>"> recomienda</a>-->
                    </li>
                    <li>
                        <?php
                        if ($sf_user->isAuthenticated())
                            echo link_to('desaprueba', 'profesionaldisaproval/' . $profesional->getId(), array('style' => 'padding-left:0px;padding-right:0px;', 'title' => 'Desaprueba a un profesional', 'class' => 'login_required recomienda', 'message' => 'Para <strong>desaprobar a un profesional</strong> necesitas ser colaborador. '));
                        else
                            echo authenticated_link_to($sf_user, "desaprueba", 'profesionaldisaproval/' . $profesional->getId(), 'desaprueba', url_for("nosotros_lightboxes/accesocuenta") . "?texto=4&redirect=" . 'profesionaldisaproval/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda', "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                                "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'));
                        ?>
                        <!--<a class="recomienda" href="<?php //echo url_for('profesionaldisaproval/'.$profesional->getId(), array('dialog_id' => 'login_required'))                                                                                      ?>"> desaprueba</a>-->
                    </li>
                    <!--li style="float: right; width: 175px; margin: -5px 87px 0 0px;">
                    <?php if ($isRecomendation): ?>
                                                                    <a class="iconRecoDesp categoria_excelencia" title="Cartas de recomendación" href="<?php echo url_for('get_recomendation', array('slug' => $profesional->getSlug())) ?>" style="margin: 3px 3px 0"><img src="/images/icon_reco.png" alt=""></a><span style="color: #FF1919;float: left;margin-top: 7px;"><strong>(<?php echo $isRecomendation; ?>)</strong></span>
                    <?php endif; ?>

                    <?php if ($isDescription): ?>
                                                                    <a class="iconRecoDesp categoria_excelencia" title="Cartas de desaprobación" href="<?php echo url_for('get_disaproval', array('slug' => $profesional->getSlug())) ?>" style="margin: 3px 3px 0"><img src="/images/icon_desp.png" alt=""></a><span style="color: #FF1919;float: left;margin-top: 7px;"><strong>(<?php echo $isDescription; ?>)</strong></span>
                    <?php endif; ?>
                    </li-->
                    <?php
                    /* if (isset($key) && !empty($key)) {
                      echo '<span class="nb_order">' . ($key) . '</span>';
                      } */
                    ?>
                </ul>
            </div>
            <div class="box_rss">
                <span class="rss" title="Añade profesionales recomendados a RSS"></span>
                <?php
                if (isset($key) && !empty($key)) {
                    echo '<span class="nb_order">' . ($key) . '</span>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="item_detail_bottom"></div>
</div>