<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic"><strong>Empresa/Entidad: </strong>
        <span class="com_company"><?php echo $company->name ?></span>
    </p>

    <?php if (($company->getStates() != "Toda España" && $company->road_type_id) || ($company->getStates() == "Toda España" && $company->road_type_id)): ?>
        <p class="left_ic"><strong>Tipo de vía: </strong><span class="com_trebute"><?php echo $company->getRoadType(); ?></span></p>
    <?php endif ?>

    <?php if (($company->getStates() != "Toda España" && $company->direccion) || ($company->getStates() == "Toda España" && $company->direccion)): ?>
        <p class="left_ic"><strong>Dirección: </strong><span class="com_trebute"><?php echo $company->direccion ?></span></p>
    <?php endif; ?>

    <?php if (($company->getStates() != "Toda España" && $company->getNumero()) || ($company->getStates() == "Toda España" && $company->getNumero())): ?>
        <p class="left_ic"><strong>Nº: </strong><span class="com_trebute"><?php echo $company->numero ?></span></p>
    <?php endif; ?>

    <?php if ($company->piso): ?>
        <p class="left_ic"><strong>Piso: </strong><span class="com_trebute"><?php echo $company->piso ?></span></p>
    <?php endif; ?>
    <?php if ($company->puerta): ?>
        <p class="left_ic"><strong>Puerta: </strong><span class="com_trebute"><?php echo $company->puerta ?></span></p>
    <?php endif; ?>

    <?php if ($company->getCpMunicipioProvinciaCongi()) : ?>
        <p class="left_ic"><strong>Localidad: </strong>
            <span class="com_localidad"><?php echo $company->getCpMunicipioProvinciaCongi(); ?></span></p>
    <?php endif; ?>

    <?php if ($company->empresa_sector_tres_id) : ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $company->getEmpresaSectorTres() ?></span>
        </p>
    <?php else: ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $company->getEmpresaSectorDos() ?></span>
        </p>
    <?php endif ?>
    <p class="left_ic"><strong>Usuario: </strong>
        <span class="com_usuario">
            <?php $user_id = $company->getUserId(); ?>
            <?php echo $company->getUserNames($user_id); ?>
        </span>
    </p>

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>DESCRIPCIÓN DEL CASO DE ÉXITO</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($company->getDescription()) ?></span>
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
    .com_usuario{ color: #FF1919; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_comment ul {margin: 10px 10px 10px 15px;}
    .empresa_comment ol {margin: 10px 10px 10px 20px;}
    .empresa_comment ul li{list-style: disc;}
</style>
