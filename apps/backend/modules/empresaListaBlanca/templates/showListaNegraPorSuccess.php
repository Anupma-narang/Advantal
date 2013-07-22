<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic"><strong>Empresa/Entidad: </strong>
        <span class="com_company"><?php echo $empresa->name ?></span>
    </p>

    <?php if ($empresa->road_type_id) : ?>
        <p class="left_ic"><strong>Tipo de vía: </strong><span class="com_trebute"><?php echo $empresa->getRoadType(); ?></span></p>
    <?php endif ?>

    <p class="left_ic"><strong>Dirección: </strong><span class="com_trebute"><?php echo $empresa->direccion ?></span></p>
    <p class="left_ic"><strong>Nº: </strong><span class="com_trebute"><?php echo $empresa->numero ?></span></p>

    <?php if ($empresa->piso): ?>
        <p class="left_ic"><strong>Piso: </strong><span class="com_trebute"><?php echo $empresa->piso ?></span></p>
    <?php endif; ?>
    <?php if ($empresa->puerta): ?>
        <p class="left_ic"><strong>Puerta: </strong><span class="com_trebute"><?php echo $empresa->puerta ?></span></p>
    <?php endif; ?>

    <?php if ($empresa->getCpMunicipioProvincia()) : ?>
        <p class="left_ic"><strong>Localidad: </strong>
            <span class="com_localidad"><?php echo $empresa->getCpMunicipioProvincia(); ?></span></p>   
    <?php endif; ?>

    <?php if ($empresa->empresa_sector_tres_id) : ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $empresa->getEmpresaSectorTres() ?></span>
        </p>
    <?php else: ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $empresa->getEmpresaSectorDos() ?></span>
        </p>
    <?php endif ?>

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic" style="margin-bottom: 0px;"><strong>LISTA NEGRA: POR QUÉ APARECE AQUÍ</strong></p>
    <span class="empresa_negra"><?php echo html_entity_decode($empresa->texto_lista_negra) ?></span>
</div>
<style type="text/css">
    .empresa_negra p{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float: left; margin: 14px 0 0 20px; }
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px;}
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    .com_company{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_trebute{ color: #7D7873; font-family: Trebuchet MS; font-size: 14px;}
    .com_localidad{ color: #429D29; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_activated{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_negra ul {margin: 10px 10px 10px 15px;}
    .empresa_negra ol {margin: 10px 10px 10px 20px;}
    .empresa_negra ul li{list-style: disc;} 
</style>