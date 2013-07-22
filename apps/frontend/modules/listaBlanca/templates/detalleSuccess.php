<?php $sf_user->setFlash('remember_last_state', true); ?>

<?php
include_partial("breadcrumb", array(
    'sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Lista blanca de empresas y entidades</a> >> <a href="%s">%s</a>', url_for('lista_blanca_empresa'), url_for('lista_blanca_empresa_detalle', array('slug' => $empresa->getSlug())), $empresa->getNameForBreadcrumb())));
?>
<?php include_partial("headerlistas") ?>
<?php use_stylesheet('caja'); ?>
<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>
<!-- buscador -->
<?php include_partial('buscadorEmpresa', array('form' => $form)) ?>
<!-- fin del buscador -->
<style type="text/css">
    ul.lista_detalles li.calle, ul.lista_detalles li.ciudad, ul.lista_detalles li.sector{
        float: left;
        padding: 3px 0 0;
        width: 310px;
    }
    .dynamicBar{
        float: none !important;
    }
</style>
<div id="content_laslistas_lista">
    <div class="menu-buscador" style="margin-top:10px;">
        <a class="empresas-entidades-activa" href="#">Empresas/Entidades</a>
        <a class="productos" href="#">Productos</a>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlanca', 'categoriaEmpresas', array('url' => 'lista_blanca_empresa')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle" style="min-height:0px;">
                    <div id='resultados_empresas'>
                        <?php include_partial('empresaDetail', array('empresa' => $empresa)); ?>
                    </div>
                </div>
                <div class="bottom"></div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <div id='resultados_empresas'>
                        <?php include_partial('empresaDetalle', array('empresa' => $empresa)); ?>
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



