<div id="content" style="padding-top: 30px !important;">

    <p class="left_ic"><strong>Producto: </strong><span class="name"> <?php echo $contribucion->getConcurso()->getProducto()->getName(); ?></span></p>
    <p class="left_ic"><strong>Marca: </strong><span class="brand"><?php echo $contribucion->getConcursoProductoMarca(); ?></span></p>
    <?php if ($contribucion->getConcursoProductoModelo()): ?>
        <p class="left_ic"><strong>Modelo: </strong><span class="model"><?php echo $contribucion->getConcursoProductoModelo() ?></span></p>
    <?php endif; ?>
    <?php if ($contribucion->getConcurso()->getProducto()->getTresProduct()->getId()) : ?>
        <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $contribucion->getConcurso()->getProducto()->getTresProduct() ?></span></p>
    <?php else: ?>
        <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $contribucion->getConcurso()->getProducto()->getSubSectorProduct() ?></span></p>
    <?php endif ?>
    <p class="left_ic"><strong>Título: </strong>
        <span class="com_titulo"><?php echo $contribucion->name; ?></span>
    </p>

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>DESCRIPCIÓN DE LA INCIDENCIA</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($contribucion->incidencia) ?></span>
</div>
<style type="text/css">
    .empresa_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float: left; margin-left: 20px;}
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    .producto_comment{ float: left; margin: 14px 0 0 20px;}
    .producto_comment p{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important;}
    .name{ color: #B41B1D; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .brand{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .model{ color: #7D7873; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .type{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .producto_comment ul {margin: 10px 10px 10px 15px;}
    .producto_comment ol {margin: 10px 10px 10px 20px;}
    .producto_comment ul li{list-style: disc;}
    .com_titulo{ color: #006400; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
</style>