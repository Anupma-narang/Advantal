<div id="content" style="padding-top: 30px !important;">
    <?php if ($concurso->ConcursoTipo->id == 1): ?>

        <p class="left_ic"><strong>Empresa/Entidad: </strong>
            <span class="com_company"><?php echo $concurso->Empresa->name ?></span>
        </p>
        <?php if (($concurso->States->name != "Toda España" && $concurso->Empresa->getRoadTypeId()) || ($concurso->States->name == "Toda España" && $concurso->Empresa->getRoadTypeId())): ?>
            <p class="left_ic"><strong>Tipo de vía: </strong><span class="com_trebute"><?php echo $concurso->Empresa->RoadType->name; ?></span></p>
        <?php endif ?>

        <?php if (($concurso->States->name != "Toda España" && $concurso->concurso_address) || ($concurso->States->name == "Toda España" && $concurso->concurso_address)): ?>
            <p class="left_ic"><strong>Dirección: </strong><span class="com_trebute"><?php echo $concurso->concurso_address ?></span></p>
        <?php endif; ?>
        <?php if (($concurso->States->name != "Toda España" && $concurso->concurso_numero) || ($concurso->States->name == "Toda España" && $concurso->concurso_numero)): ?>
            <p class="left_ic"><strong>Nº: </strong><span class="com_trebute"><?php echo $concurso->concurso_numero ?></span></p>
        <?php endif; ?>

        <?php if ($concurso->concurso_piso): ?>
            <p class="left_ic"><strong>Piso: </strong><span class="com_trebute"><?php echo $concurso->concurso_piso ?></span></p>
        <?php endif; ?>
        <?php if ($concurso->concurso_puerta): ?>
            <p class="left_ic"><strong>Puerta: </strong><span class="com_trebute"><?php echo $concurso->concurso_puerta ?></span></p>
        <?php endif; ?>
        <p class="left_ic"><strong>Localidad: </strong>
            <span class="com_localidad"><?php echo $concurso->getCpMunicipioProvinciaCongi(); ?></span>
        </p>

        <?php if ($concurso->getEmpresa()->getEmpresaSectorTresId()): ?>
            <p class="left_ic"><strong>Actividad: </strong>
                <span class="com_activated"><?php echo $concurso->getEmpresa()->getEmpresaSectorTres(); ?></span>
            </p>
        <?php else: ?>
            <p class="left_ic"><strong>Actividad: </strong>
                <span class="com_activated"><?php echo $concurso->getEmpresa()->getEmpresaSectorDos(); ?></span>
            </p>
        <?php endif ?>
        <p class="left_ic"><strong>Título: </strong>
            <span class="com_titulo"><?php echo $concurso->name; ?></span>
        </p>

    <?php elseif ($concurso->ConcursoTipo->id == 2): ?>

        <p class="left_ic"><strong>Producto: </strong><span class="name"> <?php echo $concurso->Producto->name; ?></span></p>
        <p class="left_ic"><strong>Marca: </strong><span class="brand"><?php echo $concurso->getProducto()->getMarca(); ?></span></p>
        <?php if ($concurso->getProducto()->getModelo()): ?>
            <p class="left_ic"><strong>Modelo: </strong><span class="model"><?php echo $concurso->getProducto()->getModelo() ?></span></p>
        <?php endif; ?>
        <?php if ($concurso->getProducto()->getProductoTipoTresId()) : ?>
            <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $concurso->getProducto()->getProductoTipoTres()->getName() ?></span></p>
        <?php else: ?>
            <p class="left_ic"><strong>Tipo de producto: </strong><span class="type"><?php echo $concurso->getProducto()->getProductoTipoDos()->getName() ?></span></p>
        <?php endif ?>
        <p class="left_ic"><strong>Título: </strong>
            <span class="com_titulo"><?php echo $concurso->name; ?></span>
        </p>

    <?php endif; ?>  

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>PLAN DE ACCIÓN</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($contribucion->plan_accion) ?></p></span>
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