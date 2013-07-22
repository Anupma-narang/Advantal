<?php use_helper('Text') ?>
<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic">
        <strong>Nombre:</strong>
        <strong><span class="color_red"><?php echo $contractanos->getNombre(); ?></span></strong>
    </p>
    <p class="left_ic">
        <strong>Apellido 1:</strong>
        <strong><span class="color_red"><?php echo $contractanos->getApellido1() ?></span></strong>
    </p>
    <p class="left_ic">
        <strong>Apellido 2:</strong>
        <strong><span class="color_red"><?php echo $contractanos->getApellido2() ?></span></strong>
    </p>
    <p class="left_ic">
        <strong>Localidad:</strong>
        <strong><span class="color_green"><?php echo $contractanos->getCpMunicipioProvincia() ?></span></strong>
    </p>
    <?php if($contractanos->getName()): ?>
    <p class="left_ic">
        <strong>Empresa/Entidad:</strong>
        <strong class="color_blue"><?php echo $contractanos->getName() ?></strong>
    </p>
    <?php endif; ?>
    <p class="left_ic">
        <strong>Actividad:</strong>
        <span style="color:#F65E13;font-weight: bold;"><?php echo $contractanos->getActividad() ?></span>
    </p>
    <p class="left_ic">
        <strong>Correo electrónico:</strong>
        <span style="color:#7D7873;font-weight: bold;"><?php echo $contractanos->getEmail() ?></span>
    </p>
</div>

<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>COMENTARIO</strong></p>
    <span class="contractanos_comment"><?php echo html_entity_decode($contractanos->getAyudar()) ?></span>
</div>
<style type="text/css">
    .contractanos_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; margin-left:20px; float:left;}
     p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
     .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;list-style-type: none;padding-left: 20px; }
    .contractanos_comment ol{margin: 10px 10px 10px 21px;}
    .contractanos_comment ul{margin: 10px 10px 10px 15px;}
    .contractanos_comment ul li{list-style: disc}
</style>