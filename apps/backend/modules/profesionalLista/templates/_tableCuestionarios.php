<li>
        <i><?php echo $respuesta->getDateTimeObject('created_at')->format('H:i d/m/y '); ?></i>
        <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $respuesta->getUser()->getId())?>'>
            <?php echo $respuesta->getUser() ?></a>.
        <strong>Puntuación total: </strong><?php echo $respuesta->getPuntos(); ?>

    <span class='actions'>

        <a class='display_comments' href='#ver_comentario'>Ver comentario</a>

        <div style='display:none'><?php echo $respuesta->getRawValue()->getComentario()?></div>
        <?php if (!$respuesta->isAprobado()) : ?>
        <a class='ajax_actions check'  title='¿Estás seguro de que quieres eliminar el comentario?' id='borrar_y_aprobar'
           href='<?php echo url_for('borrarComentario_y_aprobar_cuestionario', array('id' => $respuesta->getId()))?>'>Borrar
            comentario y aprobar</a>
        <a class='ajax_actions' id='aprobar'
           href='<?php echo url_for('aprobar_cuestionario', array('id' => $respuesta->getId()))?>'>Aprobar</a>
        <a class='ajax_actions check' id='delete' title='¿Seguro que quieres anular esta auditoría?'
           href='<?php echo url_for('delete_cuestionario', array('id' => $respuesta->getId()))?>'>Anular</a>
        <?php endif ?>
    </span>

</li>
