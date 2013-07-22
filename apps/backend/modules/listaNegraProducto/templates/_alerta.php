    <li>
        <?php echo $comentario->getDateTimeObject('created_at')->format('H:i d/m/y '); ?>
        <strong><?php echo $comentario->getProducto()->getNombreCompleto() ?></strong>,
        <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $comentario->getUser()->getId())?>'>
            <?php echo $comentario->getUser() ?></a>.

        <span class='actions'>

        <a class='display_comments' href='#ver_comentario'>Ver comentario</a>

        <div style='display:none'><?php echo $comentario->getRawValue()->getComentario()?></div>
            <?php if (!$comentario->isAprobado()) : ?>

            <a class='ajax_actions' id='aprobar' href='<?php echo url_for('lista_negra_aprobar_comentario', array('id' => $comentario->getId()))?>'>Aprobar</a>
            <a class='ajax_actions check' title='¿Estás seguro que quieres anular este comentario?' id='borrar' href='<?php echo url_for('lista_negra_borrar_comentario', array('id' => $comentario->getId()))?>'>Anular</a>


            <?php endif ?>
    </span>


    </li>


