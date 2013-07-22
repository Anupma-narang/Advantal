<?php
include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Lista blanca de productos</a> >> <a href="%s">%s</a>', url_for('lista_blanca_productos'), url_for('lista_blanca_producto_detalle', array('slug' => $producto->getSlug())), $producto->getNombreCompleto())));
?>
<?php include_partial("listaBlanca/headerlistas") ?>
<?php use_stylesheet('caja'); ?>
<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>

<!-- buscador -->
<?php include_partial('buscadorProductos', array('form' => $form)) ?>
<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div class="menu-buscador">
        <a class="empresas-entidades" href="<?php echo url_for('lista_blanca_empresa') ?>">Empresas/Entidades</a>
        <a class="productos-activa" href="#">Productos</a>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlancaProducto', 'categoriaProductos', array('url' => 'lista_blanca_productos')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle" style="min-height:0px;">
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
                        <?php include_partial('productoDetalle', array('producto' => $producto)); ?>
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
<script type='text/javascript'>
    $(function () {
        $('.dynamicBar').sparkline('html', {
            type:'bar',
            barColor:'green',
           colorMap:{
                '1':'#429D29',
                '2':'#B41B1D',
                '3':'#BEC1C4',
                '4':'#F65E13'
            },
            tooltipFormat:'{{value:levels}}',
            tooltipValueLookups:{
                levels:{ '1':'Sin medalla', '2':'Bronze', '3':'Plata', '4':'Oro' }
            }
        });

    })
</script>


