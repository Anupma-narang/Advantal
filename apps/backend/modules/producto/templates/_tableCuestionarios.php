<li class="producto_audit">
    <span class="producto_number">
        <span style="float: left; padding: <?php echo ($c >= 1 && $c >= 10) ? '1px 0 0 0;' : '1px 0 0 7px;' ?>"><?php echo $c; ?></span>)
        <?php $c++; ?>
    </span>
    <span class="producto_date">
        <?php echo $respuesta->getDateTimeObject('created_at')->format('d/m/Y '); ?>
    </span>
    <span class="producto_user_name">
        <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $respuesta->getUser()->getId()) ?>'>
            <?php echo $respuesta->getUser() ?></a>.
    </span>
    <span class="producto_pun_total">
        <strong>Puntuación total: </strong><?php echo $respuesta->getPuntos(); ?>
    </span>
    <span class='actions'>
        <span class="producto_comentario">
            <a class='display_comments' href='#ver_comentario'>Ver comentario</a>
            <div style='display:none'><?php echo $respuesta->getRawValue()->getComentario() ?></div>
        </span>
        <?php if (!$respuesta->isAprobado()) : ?>
            <span class="producto_comment_aprobar">
                <a class='ajax_actions check' title='¿Estás seguro de que quieres eliminar el comentario?' id='borrar_y_aprobar'
                   href='<?php echo url_for('borrarComentario_y_aprobar_cuestionario', array('id' => $respuesta->getId())) ?>'>Borrar
                    comentario y aprobar</a>
            </span>
            <span class="producto_aprobar">
                <a class='ajax_actions' id='aprobar'
                   href='<?php echo url_for('aprobar_cuestionario', array('id' => $respuesta->getId())) ?>'>Aprobar</a>
            </span>
            <span class="producto_anular">
                <a class='ajax_actions check' id='delete' title='¿Seguro que quieres anular esta auditoría?'
                   href='<?php echo url_for('delete_cuestionario', array('id' => $respuesta->getId())) ?>'>Anular</a>
            </span>
        <?php endif ?>
    </span>

</li>