<?php
$module_name = sfContext::getInstance()->getModuleName();
?>
<div class="menu-superior-listas">
    <div class="menu-listas-wrapper">
        <ul>
            <li class="lista-blanca"><a class="active" title="Lista blanca" href="<?php echo url_for('lista_blanca_empresa') ?>">Lista blanca</a></li>
            <?php if ($module_name == "listaBlanca"): ?>
                <li class="lista-negra"><a title="Lista negra" href="<?php echo url_for('lista_negra_empresa') ?>">Lista negra</a></li>
            <?php elseif ($module_name == "listaBlancaProducto"): ?>
                <li class="lista-negra"><a title="Lista negra" href="<?php echo url_for('lista_negra_producto') ?>">Lista negra</a></li>
            <?php endif; ?>
            <li class="directorio-profesionales"><a title="Directorio de buenos profesionales" href="<?php echo url_for('lista_profesional') ?>">Directorio de buenos profesionales</a></li>
        </ul>
    </div>
    <span class="separador"></span>
    <div class="menu-listas-bottom">
        <?php echo link_to("Que es la lista blanca", "nosotros/listablanca") ?> &nbsp;
        <?php echo link_to("Decálogo de la lista blanca", "nosotros/decalogolistablanca") ?>&nbsp;
        <?php echo link_to("Cómo se audita una entidad o producto", "home/index") ?>&nbsp;
        <?php echo link_to("Consejos para auditar una entidad o producto", "home/index") ?>
    </div>
</div>
