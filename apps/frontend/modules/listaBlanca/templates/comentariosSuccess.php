<div class="comentarios">
    <div class="list">
        <br />
        <?php foreach ($comentarios as $comentario): ?>
            <div class="item">
                <div class="titulo" style="color:#B41B1D;">
                    <strong>Auditoría de <span style="color: #FF1919;"><?php echo $comentario['username'] ?></span> el <?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?>:</strong>
                </div>
                <div class="comentario" style="margin-bottom: 15px;">
                    <br/>
                    <?php
                    $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $comentario->getRaw('respuesta'));
                    echo $result;
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
        <a href="<?php echo url_for($url, array('slug' => $obj->getSlug())) ?>">ver +</a>
    </div>
</div>
