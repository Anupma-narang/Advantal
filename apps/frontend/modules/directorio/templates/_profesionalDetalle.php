<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php $sf_user->setFlash('remember_last_state', true); ?>
<script type="text/javascript">
    $("#limpiar_filtro").live("click", function() {
        jQuery.ajax({
            type: 'POST',
            data: "reset=Reset",
            url: '<?php echo url_for("lista_profesional_reset"); ?>',
            success: function(data) {
                window.location.href = "<?php echo url_for("lista_profesional"); ?>#top";
            }
        });
    });
</script>
<div class="item detailList">
    <div class="col_left">
        <ul class='lista_detalles_profeshanel'>
            <li class="head_full">
                <?php $string = html_entity_decode($profesional->getLastNameOne() . ' ' . $profesional->getLastNameTwo() . ', ' . $profesional->getFirstName()); ?>
                <?php echo $string; //echo (((strlen($string) > 105) ? substr($string, 0, 105) . "..." : $string)); ?>
            </li>

            <li class="adre_full">
                <?php $dir = $profesional->getDireccionCompleta(); ?>
                <?php $dir .= ' ' . $profesional->getPisoAndPuerta(); ?>
                <strong><?php echo trim($dir); ?></strong>
                <?php if ($profesional->getStates() != 'Toda España'): ?>
                    (<a title='Cómo llegar al profesional recomendado' class='pr_map fancybox-media fancybox.iframe' href='<?php echo url_for('show_profesional_map', array('slug' => $profesional->getSlug())) ?>'>Cómo llegar</a>)
                <?php endif; ?>
            </li>

            <li class="ciu_grn" title="<?php echo $profesional->getCityState(); ?>"><?php echo $profesional->getCityState(); ?></li>
            <?php if ($profesional->getTele() != ''): ?>
                <li class="prof-tele"><?php echo $profesional->getTele() ?></li>
            <?php endif; ?>

            <?php if ($profesional->getEmailAddress() != ''): ?>
                <li class="prof-email"><?php echo $profesional->getEmailAddress() ?></li>
            <?php endif; ?>

            <?php if ($profesional->getActivityName() != ''): ?>
                <li class="sect_org_full"><?php echo $profesional->getActivityName() ?></li>
            <?php endif; ?>

            <li class="categoria_excelencia"> <?php $url = url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())); ?>
                <a title='Indicadores de excelencia' onmouseover="$('#wholeDiv<?php echo $profesional->getId(); ?>').attr('onclick', 'javascript:void(0);');" onmouseout='setUrl(<?php echo $profesional->getId(); ?>, "<?php echo $url ?>");' class='categoria_excelencia'
                   href="<?php echo url_for('lista_profesional_categoria_excelencia', array('tipo' => 'profesionales', 'slug' => $profesional->getSlug())) ?>">
                    Indicadores de excelencia
                </a>
            </li>
            <li class="fav">
                <?php echo image_tag('star.png') ?>
                <a class="favourit anadir_favoriros" href="#" title="Añade un profesional recomendado a Favoritos">añade a favoritos</a>
            </li>
        </ul>
    </div>
    <!--div id="alin_der_img" style="width:90px; padding:0px 10px; float:left;">
        <ul style="padding:0px;">

        </ul>
    </div-->
    <div id="alin_der_img" style="width:120px; float:left;">
        <ul style="padding:0px;">

            <li>
                <?php
                if ($sf_user->isAuthenticated())
                    echo link_to('recomienda', 'profesionalrecomend/' . $profesional->getId(), array('title' => 'Recomienda a un profesional', 'class' => 'login_required recomienda', 'message' => 'Para <strong>recomendar a un profesional</strong> necesitas ser colaborador.'));
                else
                    echo authenticated_link_to(
                            $sf_user, "recomienda", 'profesionalrecomend/' . $profesional->getId(), "recomienda", url_for("nosotros_lightboxes/accesocuenta") . "?texto=3&redirect=" . 'profesionalrecomend/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda',
                        "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                        "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'
                            )
                    );
                ?>
            </li>
            <li>
                <?php
                if ($sf_user->isAuthenticated())
                    echo link_to('desaprueba', 'profesionaldisaproval/' . $profesional->getId(), array('title' => 'Desaprueba a un profesional', 'class' => 'login_required recomienda', 'message' => 'Para <strong>desaprobar a un profesional</strong> necesitas ser colaborador. '));
                else
                    echo authenticated_link_to($sf_user, "desaprueba", 'profesionaldisaproval/' . $profesional->getId(), 'desaprueba', url_for("nosotros_lightboxes/accesocuenta") . "?texto=4&redirect=" . 'profesionaldisaproval/' . $profesional->getId(), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda'), array('title' => 'Formulario para auditarnos', 'class' => 'lightbox-i recomienda', "onmouseover" => "$('#wholeDiv" . $profesional->getId() . "').attr('onclick', 'javascript:void(0);');",
                        "onmouseout" => 'setUrl(' . $profesional->getId() . ', "' . $url . '");'));
                ?>
            </li>
            <li>
                <?php if ($isRecomendation): ?>
                    <a class='fancybox-media' href='<?php echo url_for('profesional_show_chart', array('title' => 'Recomendaciones frente a desaprobaciones para un profesional recomendado', 'id' => $profesional->getId())) ?>'>
                        <img src="/images/statistics.png" alt="Recomendaciones frente a desaprobaciones para un profesional recomendado" title="Recomendaciones frente a desaprobaciones para un profesional recomendado"/>
                    </a>
                <?php endif ?>
                <div class='dynamicBar' style="margin:7px 0px;">
                    <strong>
                        <?php if ($isRecomendation): ?>
                            <a class="iconRecoDesp categoria_excelencia" title="Cartas de recomendación" href="<?php echo url_for('get_recomendation', array('slug' => $profesional->getSlug())) ?>">Recomendaciones</a>&nbsp;<?php echo round($chartData[0]['reco']) . '%'; ?></br>
                        <?php endif ?>

                        <?php if ($isDescription): ?>
                            <a class="iconRecoDesp categoria_excelencia" title="Cartas de desaprobación" href="<?php echo url_for('get_disaproval', array('slug' => $profesional->getSlug())) ?>">Desaprobaciones</a>&nbsp;<?php echo round($chartData[0]['disp']) . '%'; ?></br>
                        <?php endif; ?>

                    </strong>
                </div>
            </li>
            <li>
                <?php if ($isRecomendation): ?>
                    <a class="iconRecoDesp categoria_excelencia" title="Cartas de recomendación" href="<?php echo url_for('get_recomendation', array('slug' => $profesional->getSlug())) ?>"><img src="/images/icon_reco.png" alt=""></a>
                <?php endif; ?>
                <?php if ($isDescription): ?>
                    <a class="iconRecoDesp categoria_excelencia" title="Cartas de desaprobación" href="<?php echo url_for('get_disaproval', array('slug' => $profesional->getSlug())) ?>"><img src="/images/icon_desp.png" alt=""></a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>
