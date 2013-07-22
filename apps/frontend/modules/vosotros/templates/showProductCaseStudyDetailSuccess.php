<div id="content" style="padding-top: 16px !important;">
    <p class="left_ic">
        <strong><?php echo __('Producto') ?>: </strong>
        <strong><span class="color_brown"><?php echo $product->getName() ?></span></strong>
    </p>
    <p class="left_ic">
        <strong><?php echo __('Marca') ?>: </strong>
        <strong><span class="color_blue"><?php echo $product->getMarca() ?></span></strong>
    </p>
    <?php if ($product->getModelo()): ?>
        <p class="left_ic">
            <strong><?php echo __('Modelo') ?>: </strong>
            <strong class="color_grey2"><?php echo $product->getModelo() ?></strong>
        </p>
    <?php endif; ?>

    <p class="left_ic">
        <strong><?php echo __('Tipo de producto') ?>: </strong>
        <strong><span class="color_orange"><?php echo $product->getTipo() ?></span></strong>
    </p>
    <?php if (sfContext::getInstance()->getRequest()->getParameter('type') == 'userproductcase'): ?>
        <p class="left_ic">
            <strong><?php echo __('Usuario: ') ?></strong><strong class="color_red"><?php echo $product->getUserName() ?></strong>
        </p>
    <?php endif; ?>
</div>
<hr class="line"/>
<div id="content" style="padding-top: 4px !important;">
    <p class="left_ic" style="margin-bottom: 0px;"><strong>DESCRIPCIÓN DEL CASO DE ÉXITO</strong></p>
    <span class="empresa_comment"><?php echo html_entity_decode($product->getDescription()) ?></span>
</div>
<style type="text/css">
    body{background-color: #fff; margin: 0; padding: 0;}
    div#content { padding: 10px 30px; }
    div#logo { padding: 10px 0 0 30px; }
    hr.line { background: url("/images/img/fondo1.png") repeat-y scroll -90px 0 #009321; border: 0 none; height: 5px; }
    .empresa_comment{font-family: Trebuchet MS; font-size: 14px; font-weight: normal !important; float: left; margin-left: 20px;}
    .left_ic{background: url("/images/img_nosotros/circulo-lista-2.png") no-repeat scroll left top transparent;
             list-style-type: none;
             padding-left: 20px; }
    p{ color: #000000; font-family: Trebuchet MS; font-size: 14px; }
    .com_company{ color: #166494; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_trebute{ color: #7D7873; font-family: Trebuchet MS; font-size: 14px;}
    .com_localidad{ color: #429D29; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .com_activated{ color: #F65E13; font-weight: bold; font-family: Trebuchet MS; font-size: 14px;}
    .empresa_comment ul {margin: 10px 10px 10px -5px }
    .empresa_comment ul li {margin: 0px 0px 0px -17px; list-style: disc; }
    .empresa_comment ol {margin: 10px 10px 10px -17px }
</style>