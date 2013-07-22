<?php
include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Lista negra de productos</a> >> <a href="%s">%s</a>', url_for('lista_negra_producto'), url_for('lista_negra_detalle_producto', array('slug' => $producto->getSlug())), $producto->getNameForBreadcrumb(' '))));
?>

<?php include_partial("listaNegra/headerlistas") ?>
<?php use_stylesheet('caja'); ?>
<!-- buscador -->
<?php include_partial('buscadorProductos', array('form' => $form)) ?>
<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div class="menu-buscador">
        <a class="empresas-entidades" href="<?php echo url_for('lista_negra_empresa') ?>">Empresas/Entidades</a>
        <a class="productos-activa" href="">Productos</a>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlancaProducto', 'categoriaProductos', array('url' => 'lista_negra_producto')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle" style="min-height:0;">
                    <div id='resultados_empresas'>
                        <?php include_partial('productoDetail', array('producto' => $producto)); ?>
                    </div>
                </div>
                <div class="bottom"></div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <div id='resultados_empresas'>
                        <h2 style="margin-top:0;padding: 0;">Comentarios de los consumidores</h2>
                        <?php foreach ($producto->getLastComentariosListaNegra(0, true, true) as $comentario): ?>
                            <div class="comentario_box">
                                <div class="titulo"><strong style="color: #B41B1D">Comentario de <span style="color: #FF1919"><?php echo $comentario['username'] ?></span>
                                        el <?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?>:</strong>
                                </div>
                                <div class="comentario">
                                    <?php
                                    $raw = $comentario->getRawValue();
                                    $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $raw['comentario']);
                                    echo $result;
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if ($producto->getLastComentariosListaNegra()->count() == 0) : ?>
                            <p>No hay ningún comentario</p>
                        <?php endif ?>
                        <a href='<?php echo url_for('lista_negra_producto') ?>#top'>volver a la lista negra</a>
                        <!--a href='#' id='vuelve_lista'>volver a la lista negra</a-->
                    </div>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="bottom"></div>
        </div>
    </div>
    <div class="content-bottom"></div>
</div>
<script type='text/javascript'>
    moveToTop('top');
</script>



