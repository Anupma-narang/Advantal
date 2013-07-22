<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic">
        <strong><?php echo __('Empresa/Entidad') ?>: </strong>
        <strong><span class="color_blue"><?php echo $company->getName() ?></span></strong>
    </p>
    <?php if (($company->getStates() != "Toda España" && $company->getRoadTypeId()) || ($company->getStates() == "Toda España" && $company->getRoadTypeId())): ?>
        <p class="left_ic">
            <strong><?php echo __('Tipo de vía') ?>: </strong>
            <span class="color_grey1"><?php echo $company->getRoadType() ?></span>
        </p>
    <?php endif; ?>
    <?php if (($company->getStates() != "Toda España" && $company->getDireccion()) || ($company->getStates() == "Toda España" && $company->getDireccion())): ?>
        <p class="left_ic">
            <strong><?php echo __('Dirección') ?>: </strong>
            <span class="color_grey1"><?php echo $company->getDireccion() ?></span>
        </p>
    <?php endif; ?>
    <?php if (($company->getStates() != "Toda España" && $company->getNumero()) || ($company->getStates() == "Toda España" && $company->getNumero())): ?>
        <p class="left_ic">
            <strong><?php echo __('Nº') ?>: </strong>
            <span class="color_grey1"><?php echo $company->getNumero() ?></span>
        </p>
    <?php endif; ?>

    <?php if ($company->getPiso()): ?>
        <p class="left_ic">
            <strong><?php echo __('Piso') ?>: </strong>
            <span class="color_grey1"><?php echo $company->getPiso() ?></span>
        </p>
    <?php endif; ?>

    <?php if ($company->getPuerta()): ?>
        <p class="left_ic">
            <strong><?php echo __('Puerta') ?>: </strong>
            <span class="color_grey1"><?php echo $company->getPuerta() ?></span>
        </p>
    <?php endif; ?>

    <p class="left_ic">
        <strong><?php echo __('Localidad') ?>: </strong>
        <strong><span class="color_green"><?php echo $company->getCMunicipioProvincia() ?></span></strong>
    </p>  

    <?php if ($company->getEmpresaSectorTres() && $company->getEmpresaSectorTres()->getId()): ?>
        <p class="left_ic">
            <strong><?php echo __('Actividad') ?>: </strong>
            <strong><span class="color_orange"><?php echo $company->getEmpresaSectorTres(); ?></span></strong>
        </p>
    <?php else: ?>
        <p class="left_ic">
            <strong><?php echo __('Actividad') ?>: </strong>
            <strong><span class="color_orange"><?php echo $company->getEmpresaSectorDos(); ?></span></strong>
        </p>
    <?php endif; ?>
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
    .com_trebute{ color: #7D7873; font-family: Trebuchet MS; font-size: 14px;}
    .com_localidad{ color: #429D29; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_activated{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_comment ul {margin: 10px 10px 10px -5px }
    .empresa_comment ul li {margin: 10px 10px 10px 20px; list-style: disc; }
    .empresa_comment ol {margin: 10px 10px 10px 20px }
</style>