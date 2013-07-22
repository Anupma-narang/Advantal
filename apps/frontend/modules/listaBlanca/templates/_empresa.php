<?php use_helper('mihelper'); ?>
<div class="box_main">
    <div class="box_top_c"></div>
    <?php if ($empresa->getconcursoDestacado()->getId()) : ?>
        <a href="<?php echo url_for('concurso/show?id=' . $empresa->getConcursoDestacado()->getId()) ?>">
        <?php endif ?>
        <div class="box_mid">
            <div class="box_left">
                <ul>
                    <li class="head" title="<?php echo $empresa->getName(); ?>"><?php echo $empresa->getName(); ?></li>
                    <?php if ($empresa->getStatesId() != sfConfig::get('app_valor_provincia_toda_españa', 1)) : ?>
                        <?php $dir = $empresa->getRoadType() . ' ' . $empresa->getDireccion(); ?>
                        <?php $dir .= ( $empresa->getNumero()) ? ', ' . $empresa->getNumero() : ""; ?>
                        <?php $dir = trim($dir); ?>
                        <?php
                        if ($empresa->getGoogleMap()->getId() && strlen($dir) > 30):
                            echo '<li title="' . $dir . '">';
                            echo '<div class="addr" style="width: 250px; float: left">' . $dir . '</div>';
                            echo '<div style="width: auto; float: left">(<a title="Cómo llegar a la empresa o entidad recomendada" class="fancybox-media fancybox.iframe" href="' . url_for('show_map', array('slug' => $empresa->getSlug())) . '" style="color: #4D5357">Cómo llegar</a>)</div>';
                            echo '</li>';
                        elseif ($empresa->getGoogleMap()->getId()):
                            echo '<li class="adre" title="' . $dir . '">';
                            echo '<div class="addr" style="float: left">' . $dir . '</div>';
                            echo '<div style="float: left">&nbsp;(<a title="Cómo llegar a la empresa o entidad recomendada" class="fancybox-media fancybox.iframe" href="' . url_for('show_map', array('slug' => $empresa->getSlug())) . '" style="color: #4D5357">Cómo llegar</a>)</div>';
                            echo '</li>';
                        else:
                            echo '<li class="adre" title="' . $dir . '">';
                            echo $dir;
                            echo '</li>';
                        endif;
                        ?>
                    <?php endif ?>
                    <li class="ciu_grn" title="<?php echo $empresa->getCpMunicipioProvinciaCongi(); ?>"><?php echo $empresa->getCpMunicipioProvinciaCongi(); ?></li>
                    <li class="sect_org" title="<?php echo $empresa->getTresSector(); ?>"><?php echo $empresa->getTresSector(); ?></li>
                    <li class="audit_rel">
                        <a title='Auditorías realizadas por los consumidores' rel="Auditorías de los consumidores" class='auditorias' href='<?php echo url_for('lista_blanca_comentarios', array('slug' => $empresa->getSlug(), 'tipo' => 'empresa')) ?>'>
                            Auditorías realizadas (<?php echo $empresa->countAuditoriasRealizadas() ?>)
                        </a>
                    </li>
                    <li class="indi">
                        <a title='Indicadores de excelencia para empresas y entidades recomendadas' rel="Indicadores de excelencia" class='categoria_excelencia' href="<?php echo url_for('lista_blanca_categoria_excelencia', array('tipo' => 'empresa', 'slug' => $empresa->getSlug())) ?>">
                            Indicadores de excelencia
                        </a>
                    </li>
                    <li class="fav">
                        <?php echo image_tag('star.png') ?><a href="javascript:void(0)" data-id="<?php echo $empresa->getId() ?>" title="Añade a Favoritos una empresa o entidad recomendada" class="favourit anadir_favoriros">añade a favoritos</a>
                    </li>
                </ul>
            </div>
            <div class="box_btn" style="height: auto; ">
                <?php if ($empresa->getMedalla()): ?>
                    <img class="medalla" alt="<?php echo "Medalla de " . $empresa->getMedalla() . " para empresas y entidades recomendadas por los consumidores" ?>" title="<?php echo "Medalla de " . $empresa->getMedalla() . " de la excelencia para empresas y entidades recomendadas" ?>" src="<?php echo '/images/img_listas/medalla-' . str_replace(" ", "-", strtolower($empresa->getMedalla())) . '.png' ?>" />
                <?php endif ?>
                <a title="Audita una empresa o entidad recomendada" class="btn-audita login_required" href="<?php echo url_for('lista_blanca_audita_empresa', array('slug' => $empresa->getSlug()), array('dialog_id' => 'login_required')) ?>">Audita</a>
                <?php if (null != $empresa->getEvolucionAsString()) : ?>
                    <br/>
                    <a class='fancybox-media' href='<?php echo url_for('empresa_show_chart', array('id' => $empresa->getId())) ?>' style="height: 15px !important;">
                        <div class='dynamicBar' title='Evolución de la excelencia de la empresa o entidad pública recomendada'><?php echo $empresa->getEvolucionAsString() ?></div>
                    </a>
                <?php endif ?>
            </div>
            <div class="box_rss">
                <span class="rss" title="Añade empresas y entidades recomendadas a RSS"></span>
                <?php
                if (isset($key) && !empty($key)) {
                    echo '<span class="nb_order">' . ($key) . '</span>';
                }
                ?>
            </div>
        </div>
        <?php if ($empresa->getconcursoDestacado()->getId()) : ?>
        </a>
    <?php endif ?>
    <div class="box_btm_c"></div>
</div>