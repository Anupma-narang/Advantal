<?php use_helper('Text') ?>
<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic">
        <strong>Usuario:</strong>
        <span style="color:#FF1919; font-weight: bold;">
            <?php $user_id = $audit->getUserId(); ?>
            <?php echo $audit->getUserNames($user_id); ?>
        </span>
    </p>
    <p class="left_ic">
        <strong>Localidad:</strong>
        <span style="font-weight: bold;" class="color_green">
            <?php echo $audit->getCpMunicipioProvincia($user_id); ?>
        </span>
    </p>
    <p class="left_ic">
        <strong>Correo electrónico:</strong>
        <span style="color:#7D7873;font-weight: bold;"><?php echo $audit->getEmail(); ?></span>
    </p>
    <?php if ($audit->getPhone()): ?>
        <p class="left_ic">
            <strong>Teléfono:</strong>
            <span style="color:#7D7873;font-weight: bold;"><?php echo $audit->getPhone(); ?></span>
        </p>
    <?php endif; ?>
</div>

<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>PLAN DE ACCIÓN</strong></p>
    <span class="contractanos_comment"><?php echo html_entity_decode($audit->getPlan()) ?></span>
</div>

<style type="text/css">
    .contractanos_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float:left;margin-left:20px;}
    .contractanos_comment p{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important;}
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;list-style-type: none;padding-left: 20px; }
    .contractanos_comment ul {margin: 10px 10px 10px 15px;}
    .contractanos_comment ol {margin: 10px 10px 10px 20px;}
    .contractanos_comment ul li{list-style: disc;}
</style>