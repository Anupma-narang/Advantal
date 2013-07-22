<?php use_helper('mihelper'); ?>
<?php use_stylesheet("/css/box_style.css") ?>
<script type="text/javascript">
    $("#limpiar_filtro").live("click", function(){
        jQuery.ajax({
            type:'POST',
            data: "reset=Reset",
            url: '<?php echo url_for("lista_negra_empresa_reset"); ?>',
            success:function(data){
                window.location.href="<?php echo url_for("lista_negra_empresa"); ?>#top";
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
                    <li class="head_full" title="<?php echo $empresa->getName(); ?>"><?php echo $empresa->getName(); ?></li>
                    <?php if ($empresa->getStatesId() != sfConfig::get('app_valor_provincia_toda_españa', 1)) : ?>
                        <?php $dir = $empresa->getDireccionCompleta(); ?>
                        <?php $dir = trim($dir); ?>
                        <li class="adre_full" title="<?php echo $dir; ?>">
                            <?php
                            echo $dir;
                            if ($empresa->getGoogleMap()->getId()):
                                ?>
                                (<a title='Cómo no llegar a la empresa o entidad no recomendada' class='fancybox-media fancybox.iframe' href='<?php echo url_for('show_map', array('slug' => $empresa->getSlug())) ?>'>Cómo no llegar</a>)
                            <?php endif; ?>
                        </li>
                    <?php endif ?>
                    <li class="ciu_grn" title="<?php echo $empresa->getCpMunicipioProvinciaCongi(); ?>"><?php echo $empresa->getCpMunicipioProvinciaCongi(); ?></li>
                    <li class="sect_org_full" title="<?php echo $empresa->getTresSector(); ?>"><?php echo $empresa->getTresSector(); ?></li>
                    <li class="audit_rel">
                        <a title='Comentarios de los consumidores' rel="Comentarios de los consumidores" class='auditorias' href='<?php echo url_for('lista_negra_comentarios', array('slug' => $empresa->getSlug(), 'tipo' => 'empresa')) ?>'>Comentarios</a>
                    </li>
                    <li class="indi">
                        <a title='Por qué aparece aquí esta empresa o entidad no recomendada' rel="¿Por qué aparece aquí?" class='texto_lista_negra' href='javascript:void(0);'>¿Por qué aparece aquí?</a>
                        <div style='display:none'><span style="float: left; margin-top:20px; font-size: 14px;"><?php echo $sf_data->getRaw('empresa')->getTextoListaNegra(); ?></span></div>
                    </li>
                    <li class="fav">
                        <?php echo image_tag('star.png') ?>&nbsp;<a href="javascript:void(0)" data-id="<?php echo $empresa->getId() ?>" title="Añade a Favoritos una empresa o entidad recomendada" class="favourit anadir_favoriros">añade a favoritos</a>
                    </li>
                </ul>
            </div>
            <div class="box_btn" style="height: auto; ">
                <?php if ($empresa->getMedalla()): ?>
                    <img class="medalla" alt="<?php echo "Medalla de " . $empresa->getMedalla() . " para empresas y entidades recomendadas por los consumidores" ?>" title="<?php echo "Medalla de " . $empresa->getMedalla() . " de la excelencia para empresas y entidades recomendadas" ?>" src="<?php echo '/images/img_listas/medalla-' . str_replace(" ", "-", strtolower($empresa->getMedalla())) . '.png' ?>" />
                <?php endif ?>
                <a title="Comenta una empresa o entidad no recomendada" class="btn-audita login_required" href="<?php echo url_for('lista_negra_empresa_comenta', array('slug' => $empresa->getSlug()), array('dialog_id' => 'login_required')) ?>">Comenta</a>
            </div>
            <div class="box_rss">
                <span class="rss" title="Añade empresas y entidades recomendadas a RSS"></span>
            </div>
        </div>
        <?php if ($empresa->getconcursoDestacado()->getId()) : ?>
        </a>
    <?php endif ?>
    <div class="box_btm_c"></div>
</div>