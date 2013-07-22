<?php use_helper('mihelper'); ?>
<?php use_stylesheet("/css/box_style.css") ?>
<script type="text/javascript">
    $("#limpiar_filtro").live("click", function(){
        jQuery.ajax({
            type:'POST',
            data: "reset=Reset",
            url: '<?php echo url_for("lista_blanca_producto_reset"); ?>',
            success:function(data){
                window.location.href="<?php echo url_for("lista_blanca_productos"); ?>#top";
            }
        });
    });
</script>
<div class="box_main">
    <div class="box_top_c"></div>
    <div class="box_mid">
        <div class="box_left">
            <ul>
                <li class="prod_head">
                    <?php if ($producto->getconcursoDestacado()->getId()) : ?>
                        <a href="<?php echo url_for('concurso/show?id=' . $producto->getConcursoDestacado()->getId()) ?>">
                            <?php echo '<strong style="color:#B41B1D;"> ' . $producto->getName() . '</strong>
                                        <strong style="color:#166393;"> ' . $producto->getMarca() . '</strong>' ?>
                        </a>
                        <?php echo '<strong style="color:#7D7873;"> ' . $producto->getModelo() . '</strong>'; ?>
                    <?php else: ?>
                        <?php echo '<strong style="color:#B41B1D;"> ' . $producto->getName() . '</strong>
                                    <strong style="color:#166393;"> ' . $producto->getMarca() . '</strong>
                                    <strong style="color:#7D7873;"> ' . $producto->getModelo() . '</strong>'; ?>
                    <?php endif ?>
                </li>
                <li class="sect_org_full"><?php echo $producto->getTresProduct(); ?></li>
                <li class="audit_rel">
                    <a class='auditorias' rel="Auditorías de los consumidores" title='Auditorías realizadas por los consumidores' href='<?php echo url_for('lista_blanca_comentarios', array('slug' => $producto->getSlug(), 'tipo' => 'producto')) ?>'>Auditorías realizadas (<?php echo $producto->countAuditoriasRealizadas() ?>)</a>
                </li>
                <li class="indi">
                    <a class='categoria_excelencia' rel="Indicadores de excelencia" title='Indicadores de excelencia para productos recomendados' href="<?php echo url_for('lista_blanca_categoria_excelencia', array('tipo' => 'producto', 'slug' => $producto->getSlug())) ?>">
                        Indicadores de excelencia
                    </a>
                </li>
                <li class="fav">
                    <?php echo image_tag('star.png') ?><a href="javascript:void(0)" data-id="<?php echo $producto->getId() ?>" title="Añade a Favoritos un producto recomendado" class="favourit anadir_favoriros">añade a favoritos</a>
                </li>
            </ul>
        </div>
        <div class="box_btn" style="height: auto; ">
            <?php if ($producto->getMedalla()): ?>
                <img class="medalla" alt="<?php echo "Medalla de " . $producto->getMedalla() . " para productos recomendados por los consumidores" ?>" title="<?php echo "Medalla de " . $producto->getMedalla() . " de la excelencia para productos recomendados" ?>" src="<?php echo '/images/img_listas/medalla-' . str_replace(" ", "-", strtolower($producto->getMedalla())) . '.png' ?>"/>
            <?php endif ?>

            <a title="Audita un producto recomendado" class="btn-audita login_required" href="<?php echo url_for('lista_blanca_audita_producto', array('slug' => $producto->getSlug()), array('dialog_id' => 'login_required')) ?>">Audita</a>

            <?php if (null != $producto->getEvolucionAsString()) : ?>
                <br />
                <a class='fancybox-media' href='<?php echo url_for('producto_show_chart', array('id' => $producto->getId())) ?>'>
                    <div class='dynamicBar' title='Evolución de la excelencia del producto recomendado'><?php echo $producto->getEvolucionAsString() ?></div>
                </a>
            <?php endif ?>
        </div>
        <div class="box_rss">
            <span class="rss" title="Añade productos recomendados a RSS"></span>
            <?php
            if (isset($key) && !empty($key)) {
                echo '<span class="nb_order">' . ($key) . '</span>';
            }
            ?>
        </div>
    </div>
    <div class="box_btm_c"></div>
</div>