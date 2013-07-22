<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic"><strong>Producto: </strong><span class="name"> <?php echo $producto; ?></span></p>
    <p class="left_ic"><strong>Marca: </strong><span class="brand"><?php echo $producto->getMarca(); ?></span></p>
    <?php if ($producto->getModelo()): ?>
        <p class="left_ic"><strong>Modelo: </strong><span class="model"><?php echo $producto->getModelo() ?></span></p>
    <?php endif; ?>

    <?php if ($producto->getProductoTipoTres()->getId()) : ?>
        <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $producto->getTipo() ?></span></p>
    <?php else: ?>
        <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $producto->getProductoTipoDos() ?></span></p>
    <?php endif ?>
</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic" style="margin-bottom: 0px;"><strong>LISTA NEGRA: POR QUÉ APARECE AQUÍ</strong></p>
    <span class="producto_negra"><?php echo html_entity_decode($producto->texto_lista_negra) ?></span>
</div>


<style type="text/css">
    .producto_negra {float: left; margin: 14px 0 0 20px;}
    .producto_negra p{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important;}
    p{font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    .name{ color: #B41B1D;}    
    .brand{ color: #166494;}    
    .model{ color: #7D7873;}    
    .type{ color: #F65E13;}     
    .producto_negra ul {margin-left: 15px;}
    .producto_negra ul li{list-style: disc}
    .producto_negra ol{margin-left: 20px;}
</style>