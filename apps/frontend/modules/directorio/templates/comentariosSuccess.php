<div class="comentarios">
    <div class="list">
        <?php foreach ($comentarios as $comentario): ?>
        <div class="item">
            <div class="titulo">
                <strong>Comentario de <?php echo $comentario['username'] ?>
                el <?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y')?> :</strong>
            </div>
            <div class="comentario"><?php echo $comentario->getRaw('respuesta'); ?></div>
        </div>
        <?php endforeach; ?>
        <a href="<?php echo url_for($url, array('slug' => $obj->getSlug()))?>">ver +</a>
    </div>
</div>
