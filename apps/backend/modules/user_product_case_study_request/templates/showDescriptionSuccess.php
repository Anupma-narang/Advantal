<div id="content" style="padding-top: 30px !important;">
    <p class="left_ic">
        <strong><?php echo __('Producto: ') ?></strong><strong class="color_brown"><?php echo $product->getName() ?></strong>
    </p>
    <p class="left_ic">
        <strong><?php echo __('Marca: ') ?></strong><strong class="color_blue"><?php echo $product->getMarca() ?></strong>
    </p>
    <?php if ($product->getModelo()): ?>
        <p class="left_ic">
            <strong><?php echo __('Modelo: ') ?></strong><strong class="color_grey2"><?php echo $product->getModelo() ?></strong>
        </p>
    <?php endif; ?>
    <p class="left_ic">
        <strong><?php echo __('Tipo de producto: ') ?></strong><strong class="color_orange"><?php echo $product->getTipo() ?></strong>
    </p>
    <p class="left_ic">
        <strong><?php echo __('Usuario: ') ?></strong><strong class="color_red"><?php echo $product->getUserName() ?></strong>
    </p>
</div>
<hr class="line"/>
<div id="content" style="padding-top: 20px !important;">
    <p class="left_ic"><strong><?php echo __('DESCRIPCIÓN DEL CASO DE ÉXITO:') ?></strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($product->getDescription()) ?></span>
</div>
<style type="text/css">
    .empresa_comment{ font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; margin-left: 20px; float: left}
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;list-style-type: none;padding-left: 20px; }
    .com_company{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_trebute{ color: #BEC1C4; font-family: Trebuchet MS; font-size: 14px;}
    .com_localidad{ color: #429D29; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_activated{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_usuario{ color: #FF1919; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_comment ul {margin: 10px 10px 10px 15px;}
    .empresa_comment ol {margin: 10px 10px 10px 20px;}
    .empresa_comment ul li{list-style: disc;}
</style>
