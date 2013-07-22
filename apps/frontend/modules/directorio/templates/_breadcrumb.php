<div id="content_breadcroum">
    <?php echo link_to("Inicio", "home/index") ?> >> <a href='<?php echo url_for('lista_blanca_empresa')?>'>Las Listas</a>
    >>
    <?php echo isset($lista) ? $sf_data->getRaw('lista') : '' ?>
    <?php if ($sectoresActivos) : ?>
    <?php if (isset($sectoresActivos['sector1']))  : ?>
        >> <a
            href='<?php echo url_for('lista_blanca_empresa', array('sector1' => $sectoresActivos['sector1']['slug']))?>'><?php echo $sectoresActivos['sector1']['texto']?></a>
        <?php endif ?>
    <?php if (isset($sectoresActivos['sector2']))  : ?>
        >> <a
            href='<?php echo url_for('lista_blanca_empresa', array('sector2' => $sectoresActivos['sector2']['slug']))?>'><?php echo $sectoresActivos['sector2']['texto']?></a>
        <?php endif ?>

    <?php if (isset($sectoresActivos['sector3']))  : ?>
        >> <a
            href='<?php echo url_for('lista_blanca_empresa', array('sector3' => $sectoresActivos['sector3']['slug']))?>'><?php echo $sectoresActivos['sector3']['texto']?></a>
        <?php endif ?>
    <?php endif ?>
</div> 