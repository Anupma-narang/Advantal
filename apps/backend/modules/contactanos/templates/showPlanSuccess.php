<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic"><strong>Nombre: </strong>
        <span class="com_company"><?php echo $contactanos->nombre ?></span>
    </p>

    <p class="left_ic"><strong>Apellido 1: </strong><span class="com_company"><?php echo $contactanos->apellido1 ?></span></p>
    <p class="left_ic"><strong>Apellido 2: </strong><span class="com_company"><?php echo $contactanos->apellido2 ?></span></p>

    <?php if ($contactanos->user_id): ?>
        <p class="left_ic"><strong>Usuario: </strong>
            <span class="com_user">
                <?php $user_id = $contactanos->user_id ?>
                <?php echo $contactanos->getUserNames($user_id); ?>
            </span>
        </p>
    <?php endif; ?>
    <p class="left_ic"><strong>Correo electrónico: </strong><span class="com_trebute"><?php echo $contactanos->email ?></span></p>


</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong>COMENTARIO</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($contactanos->getComentario()) ?></span>
</div>
<style type="text/css">
    .empresa_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float: left; margin-left: 20px;}
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    .com_company{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_trebute{ color: #7D7873; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_user{ color: #FF1919; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
</style>