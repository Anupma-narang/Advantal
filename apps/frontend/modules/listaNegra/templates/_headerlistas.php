<?php
    $action = sfContext::getInstance()->getActionName();
?>
<div class="menu-superior-listas">
    <div class="menu-listas-wrapper">
        <ul>
            <?php if($action == "indexProductos"): ?>
                <li class="lista-blanca"><a class='' title="Lista blanca" href="<?php echo url_for('lista_blanca_productos')?>">Lista blanca</a></li>
            <?php elseif($action == "indexEmpresas"): ?>
                <li class="lista-blanca"><a class='' title="Lista blanca" href="<?php echo url_for('lista_blanca_empresa')?>">Lista blanca</a></li>
            <?php elseif($action == "detalle" || $action == "addComentario"): ?>
                <li class="lista-blanca"><a class='' title="Lista blanca" href="<?php echo url_for('lista_blanca_empresa')?>">Lista blanca</a></li>
            <?php endif; ?>
            <li class="lista-negra"><a class='active' title="Lista negra" href="<?php echo url_for('lista_negra_empresa')?>">Lista negra</a></li>
            <li class="directorio-profesionales"><a title="Directorio de buenos profesionales" href="<?php echo url_for('lista_profesional')?>">Directorio de buenos profesionales</a></li>
        </ul>
    </div>
    <span class="separador"></span>

    <div class="menu-listas-bottom">
        <?php echo link_to("Qué es la lista negra", "nosotros/listanegra") ?> &nbsp;
        <?php echo link_to("Decálogo de la lista negra", "nosotros/decalogolistanegra") ?>&nbsp;
        <?php echo link_to("Cómo se entra en la lista negra", "nosotros/comoformarnegra") ?>&nbsp;
        <?php echo link_to("Cómo salir de la lista negra", "nosotros/comosalirlistanegra") ?>
    </div>
</div>
