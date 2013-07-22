<?php use_helper('mihelper'); ?>
<?php use_stylesheet("/css/box_style.css") ?>
<script type="text/javascript">
    $("#limpiar_filtro").live("click", function(){
        jQuery.ajax({
            type:'POST',
            data: "reset=Reset",
            url: '<?php echo url_for("lista_blanca_empresa_reset"); ?>',
            success:function(data){
                window.location.href="<?php echo url_for("lista_blanca_empresa"); ?>#top";
            }
        });
    });
</script>
<div class="box_main">
    <div class="box_top_c"></div>
    <?php if ($empresa->getconcursoDestacado()->getId()) : ?>
        <a href="<?php echo url_for('concurso/show?id=' . $empresa->getConcursoDestacado()->getId()) ?>">
        <?php endif ?>
        <div class="box_mid">
            <div class="box_left">
                <ul>
                    <li class="head_full"><?php echo $empresa->getName(); ?></li>
                    <?php if ($empresa->getStatesId() != sfConfig::get('app_valor_provincia_toda_españa', 1)) : ?>
                        <li class="adre_full">
                            <?php $dir = $empresa->getRoadType() . ' ' . $empresa->getDireccion(); ?>
                            <?php $dir .= ( $empresa->getNumero()) ? ', ' . $empresa->getNumero() : ""; ?>
                            <?php echo $dir = trim($empresa->getDireccionCompleta()); ?>
                            <?php if ($empresa->getGoogleMap()->getId()): ?>
                                (<a title='Cómo llegar a la empresa o entidad recomendada' class='fancybox-media fancybox.iframe' href='<?php echo url_for('show_map', array('slug' => $empresa->getSlug())) ?>'>Cómo llegar</a>)
                            <?php endif; ?>
                        </li>
                    <?php endif ?>
                    <li class="ciu_grn"><?php echo $empresa->getCpMunicipioProvinciaCongi(); ?></li>
                    <li class="sect_org_full"><?php echo $empresa->getTresSector(); ?></li>
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
            <div class="box_btn">
                <?php if ($empresa->getMedalla()): ?>
                    <img class="medalla" alt="<?php echo "Medalla de " . $empresa->getMedalla() . " para empresas y entidades recomendadas por los consumidores" ?>" title="<?php echo "Medalla de " . $empresa->getMedalla() . " de la excelencia para empresas y entidades recomendadas" ?>" src="<?php echo '/images/img_listas/medalla-' . str_replace(" ", "-", strtolower($empresa->getMedalla())) . '.png' ?>" />
                <?php endif ?>
                <a title="Audita una empresa o entidad recomendada" class="btn-audita login_required" href="<?php echo url_for('lista_blanca_audita_empresa', array('slug' => $empresa->getSlug()), array('dialog_id' => 'login_required')) ?>">Audita</a>
                <?php if (null != $empresa->getEvolucionAsString()) : ?>
                    <br/>
                    <a class='fancybox-media' href='<?php echo url_for('empresa_show_chart', array('id' => $empresa->getId())) ?>'>
                        <div class='dynamicBar' title='Evolución de la excelencia de la empresa o entidad pública recomendada'><?php echo $empresa->getEvolucionAsString() ?></div>
                    </a>
                <?php endif ?>
            </div>
            <div class="box_rss"><span class="rss" title="Añade empresas y entidades recomendadas a RSS"></span></div>
        </div>
        <?php if ($empresa->getconcursoDestacado()->getId()) : ?>
        </a>
    <?php endif ?>
    <div class="box_btm_c"></div>
</div>