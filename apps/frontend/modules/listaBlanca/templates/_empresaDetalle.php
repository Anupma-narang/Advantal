<div style="clear: both;"></div>
<?php $sf_user->setFlash('remember_last_state', true); ?>
<!--h2><?php echo $empresa->getName() ?></h2-->
<h2 style="margin-top: 0px; padding: 0px;">Auditorías de los consumidores</h2>
<div class="comentario_box">
    <div class="titulo" style="color: #B41B1D;"><strong>Auditoría de <span style="color: #FF1919;">auditoscopia</span> el <?php echo date_format(new DateTime($empresa->getCreatedAt()), 'd/m/Y') ?>:</strong></div>
    <div class="comentario">
        <?php
        $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $sf_data->getRaw('empresa')->getComentarioInicial());
        echo $result;
        ?>
    </div>
</div>
<?php foreach ($empresa->getLastComentarios(0, "ASC") as $comentario): ?>
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
<a href='<?php echo url_for('lista_blanca_empresa') ?>#top'>vuelve a la empresa/entidad</a>
<!-- <a href='#' id='vuelve_lista'>vuelve a la empresa/entidad</a> -->