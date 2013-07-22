<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic"><strong>Apellido 1: </strong>
        <span class="com_company"><?php echo $professional_des->getLastNameOne(); ?></span>
    </p>
    <p class="left_ic"><strong>Apellido 2: </strong>
        <span class="com_company"><?php echo $professional_des->last_name_two; ?></span>
    </p>
    <p class="left_ic"><strong>Nombre: </strong>
        <span class="com_company"><?php echo $professional_des->first_name; ?></span>
    </p>
    <?php if (($professional_des->getStates() != "Toda España" && $professional_des->getRoadTypeId()) || ($professional_des->getStates() == "Toda España" && $professional_des->getRoadTypeId())): ?>
        <p class="left_ic"><strong>Tipo de vía: </strong><span class="com_trebute"><?php echo $professional_des->getRoadType(); ?></span></p>
    <?php endif; ?>
    <?php if (($professional_des->getStates() != "Toda España" && $professional_des->address) || ($professional_des->getStates() == "Toda España" && $professional_des->address)): ?>
        <p class="left_ic"><strong>Dirección: </strong><span class="com_trebute"><?php echo $professional_des->address; ?></span></p>
    <?php endif; ?>
    <?php if (($professional_des->getStates() != "Toda España" && $professional_des->numero) || ($professional_des->getStates() == "Toda España" && $professional_des->numero)): ?>
        <p class="left_ic"><strong>Nº: </strong><span class="com_trebute"><?php echo $professional_des->numero; ?></span></p>
    <?php endif; ?>
    <?php if ($professional_des->piso): ?>
        <p class="left_ic"><strong>Piso: </strong><span class="com_trebute"><?php echo $professional_des->piso; ?></span></p>
    <?php endif; ?>
    <?php if ($professional_des->puerta): ?>
        <p class="left_ic"><strong>Puerta: </strong><span class="com_trebute"><?php echo $professional_des->puerta; ?></span></p>
    <?php endif; ?>
    <p class="left_ic"><strong>Localidad: </strong><span class="com_localidad"><?php echo $professional_des->getCpMunicipioProvinciaCongi(); ?></span></p>
    <?php if ($professional_des->getProfesionalTipoTres()->getId()) : ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $professional_des->getProfesionalTipoTres() ?></span>
        </p>
    <?php else: ?>
        <p class="left_ic"><strong>Actividad: </strong>
            <span class="com_activated"><?php echo $professional_des->getProfesionalTipoDos() ?></span>
        </p>
    <?php endif ?>

</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>DESAPROBACIÓN</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($cartas->description) ?></span>
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
    .empresa_comment ul {margin: 10px 10px 10px 15px;}
    .empresa_comment ol {margin: 10px 10px 10px 20px;}
    .empresa_comment ul li{list-style: disc;}
</style>
