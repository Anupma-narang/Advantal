<?php use_helper('jQuery') ?>
<?php include_partial("listaBlancaProducto/breadcrumb", array('sectoresActivos' => $sectoresActivos,
    'lista' => '<strong>Lista blanca de productos</strong>')) ?>
<?php include_partial("listaBlanca/headerlistas") ?>
<?php include_partial('global/alert_window'); ?>
<?php use_stylesheet('caja'); ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>
<!-- buscador -->
<?php include_partial('buscadorProductos', array('form' => $form)) ?>
<style type="text/css">
    .spanMsg{
        bottom: 0 !important;
        font-weight: bold !important;
        margin: -16px 0 0 !important;
        position: absolute !important;
        right: 0 !important;
        vertical-align: top !important;
    }
</style>
<!-- fin del buscador -->
<div id="content_laslistas_lista">
    <div class="menu-buscador" style="margin-top:10px;">
        <a class="empresas-entidades" href="<?php echo url_for('lista_blanca_empresa') ?>">Empresas/Entidades</a>
        <a class="productos-activa" href="#">Productos</a>
        <div class="spanMsg"></div><div class="clear"></div>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlancaProducto', 'categoriaProductos', array('url' => 'lista_blanca_productos')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order">
                    <?php include_partial('ordena', array('sortForm' => $sortForm)); ?>
                </div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <?php if (isset($empresa_sector_uno)): ?>
                        <div class="title">
                            <?php echo image_tag('/images/uploads/thumbnails/' . $empresa_sector_uno->getImage(), array('class' => 'miniatura-categoria')) ?>
                            <span><?php echo $empresa_sector_uno->getName() ?></span>
                        </div>
                    <?php endif ?>

                    <div id='resultados_empresas'>
                        <?php include_partial('resultadosProductos', array('pager' => $pager, 'productosDestacados' => $productosDestacados, 'buscandoPorSector' => $buscandoPorSector, 'ms_values' => $ms_values, 'sectoresActivos' => $sectoresActivos)); ?>

                    </div>
                    <?php include_partial('global/black_board', array('section' => 'LBP')) ?>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="bottom"></div>
        </div>
    </div>

    <div class="content-bottom"></div>
</div>


<?php
include_partial('global/login_required', array(
    'msg' => "Para <strong>auditar</strong> necesitas ser colaborador.",
));
?>
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" id="user_message_content">
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>


