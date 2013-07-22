<li class="empresa_audit">
    <span class="empresa_number">
        <span style="float: left; padding: <?php echo ($c >= 1 && $c >= 10) ? '1px 0 0 0;' : '1px 0 0 7px;' ?>"><?php echo $c; ?></span>)
    </span>
    <span class="empresa_date">
        <?php echo $comentario->getDateTimeObject('created_at')->format('d/m/Y '); ?>
    </span>
    <span class="empresa_user_name">
        <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $comentario->getUser()->getId()) ?>'>
            <?php echo $comentario->getUser() ?></a>
    </span>
    <span class="empresa_ver_comment">
        <a class='display_comments' href='#ver_comentario'>Ver comentario</a>
        <div style='display:none'><?php echo $comentario->getRawValue()->getComentario() ?></div>
    </span>
    <span class='actions'>
        <?php if (!$comentario->isAprobado()) : ?>
            <span class="empresa_aprobar">
                <a class='ajax_actions' id='aprobar'
                   href='<?php echo url_for('lista_negra_aprobar_comentario', array('id' => $comentario->getId())) ?>'>Aprobar</a>
            </span>
        <?php endif ?>
        <span class="empresa_anular">
            <a class='ajax_actions check' title='¿Estás seguro que quieres anular este comentario?' id='borrar'
               href='<?php echo url_for('lista_negra_borrar_comentario', array('id' => $comentario->getId())) ?>'>Anular</a>
        </span>

    </span>
</li>



