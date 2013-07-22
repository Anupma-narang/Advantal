<!--h2><?php echo $producto->getNombreCompleto() ?></h2--->
<h2 style="margin-top: 0px; padding: 0px;">Auditorías de los consumidores</h2>
<div class="comentario_box">
    <div class="titulo" style="color: #B41B1D;"><strong>Auditoría de <span style="color: #FF1919;">auditoscopia</span> el <?php echo date_format(new DateTime($producto->getCreatedAt()), 'd/m/Y') ?>:</strong></div>
    <div class="comentario">
        <?php
        $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $sf_data->getRaw('producto')->getComentarioInicial());
        echo $result;
        ?>
    </div>
</div>
<?php foreach ($producto->getLastComentarios() as $comentario): ?>
    <div class="comentario_box">
        <div class="titulo" style="color: #B41B1D;"><strong>Auditoría de <span style="color: #FF1919;"><?php echo $comentario['username'] ?></span>
                el <?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?>:</strong></div>
        <div class="comentario">
            <?php
            $raw = $comentario->getRawValue();
            $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $raw['respuesta']);
            echo $result;
            ?>
        </div>
    </div>
<?php endforeach; ?>
<a href='<?php echo url_for('lista_blanca_productos') ?>#top'>vuelve al producto</a>
<!-- <a href='#' id='vuelve_lista'>vuelve al producto</a> -->