<div class="menu-superior-listas">
    <div class="menu-listas-wrapper">
        <ul>
            <li class="lista-blanca"><a class="active" title="Lista blanca" href="<?php echo url_for('lista_blanca_empresa')?>">Lista blanca</a></li>
            <li class="lista-negra"><a title="Lista negra" href="<?php echo url_for('lista_negra_empresa')?>">Lista negra</a></li>
            <li class="directorio-profesionales"><a title="Directorio de buenos profesionales" href="<?php echo url_for('lista_profesional')?>">Directorio de
                buenos profesionales</a></li>
        </ul>
    </div>
    <span class="separador"></span>
    <div class="menu-listas-bottom">
        <?php echo link_to("¿Qué es el Directorio?", "nosotros/directorio") ?> &nbsp;
        <?php echo link_to("¿Cómo funciona el Directorio?", "preguntasfrecuentes/auditarListas#K") ?>&nbsp;
        <?php echo link_to("¿Qué es una carta de recomendación?", "preguntasfrecuentes/auditarListas#I") ?>&nbsp;
        <?php echo link_to("¿Qué es una carta de desaprobación?", "preguntasfrecuentes/auditarListas#I") ?>
    </div>
</div>
