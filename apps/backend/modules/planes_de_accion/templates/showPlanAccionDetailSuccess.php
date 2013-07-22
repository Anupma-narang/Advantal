<div id="content" style="padding-top: 30px !important;">
    <?php if ($contribucion->getConcurso()->getConcursoTipoId() == 1): ?>

        <p class="left_ic"><strong>Empresa/Entidad: </strong>
            <span class="com_company"><?php echo $contribucion->getConcurso()->getEmpresa(); ?></span>
        </p>

        <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getConcurso()->getEmpresa()->getRoadTypeId()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getConcurso()->getEmpresa()->getRoadTypeId())): ?>
            <p class="left_ic"><strong>Tipo de vía: </strong><span class="com_trebute"><?php echo $contribucion->getEmpresaRoadType(); ?></span></p>
        <?php endif ?>

        <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getConcurso()->getEmpresa()->getDireccion()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getConcurso()->getEmpresa()->getDireccion())): ?>
            <p class="left_ic"><strong>Dirección: </strong><span class="com_trebute"><?php echo $contribucion->getConcurso()->getEmpresa()->getDireccion(); ?></span></p>
        <?php endif; ?>
        <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getConcurso()->getEmpresa()->getNumero()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getConcurso()->getEmpresa()->getNumero())): ?>
            <p class="left_ic"><strong>Nº: </strong><span class="com_trebute"><?php echo $contribucion->getConcurso()->getEmpresa()->getNumero(); ?></span></p>
        <?php endif; ?>
        <?php if ($contribucion->getConcurso()->getEmpresa()->getPiso()): ?>
            <p class="left_ic"><strong>Piso: </strong><span class="com_trebute"><?php echo $contribucion->getConcurso()->getEmpresa()->getPiso(); ?></span></p>
        <?php endif; ?>
        <?php if ($contribucion->getConcurso()->getEmpresa()->getPiso()): ?>
            <p class="left_ic"><strong>Puerta: </strong><span class="com_trebute"><?php echo $contribucion->getConcurso()->getEmpresa()->getPuerta(); ?></span></p>
        <?php endif; ?>

        <p class="left_ic"><strong>Localidad: </strong>
            <span class="com_localidad"><?php echo $contribucion->getCpMunicipioProvinciaPlanState(); ?></span>
        </p>

        <?php if ($contribucion->getConcurso()->getEmpresa()->getTresSector()->getId()) : ?>
            <p class="left_ic"><strong>Actividad: </strong>
                <span class="com_activated"><?php echo $contribucion->getConcurso()->getEmpresa()->getTresSector(); ?></span>
            </p>
        <?php else: ?>
            <p class="left_ic"><strong>Actividad: </strong>
                <span class="com_activated"><?php echo $contribucion->getConcurso()->getEmpresa()->getSubSector(); ?></span>
            </p>
        <?php endif ?>
        <p class="left_ic"><strong>Título: </strong>
            <span class="com_titulo"><?php echo $contribucion->name; ?></span>
        </p>

    <?php else: ?>

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
    <?php endif; ?>

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>PLAN DE ACCIÓN</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($contribucion->plan_accion) ?></span>
</div>
<style type="text/css">
    .empresa_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float: left; margin-left: 20px;}
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    .com_company{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_trebute{ color: #BEC1C4; font-family: Trebuchet MS; font-size: 14px;}
    .com_localidad{ color: #429D29; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_activated{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_titulo{ color: #006400; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_comment ul {margin: 10px 10px 10px 15px;}
    .empresa_comment ol {margin: 10px 10px 10px 20px;}
    .empresa_comment ul li{list-style: disc;}

    .producto_comment{ float: left; margin: 14px 0 0 20px;}
    .producto_comment p{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important;}
    .name{ color: #B41B1D; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .brand{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .model{ color: #7D7873; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .type{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}    
    .producto_comment ul {margin: 10px 10px 10px 15px;}
    .producto_comment ol {margin: 10px 10px 10px 20px;}
    .producto_comment ul li{list-style: disc;}
</style>