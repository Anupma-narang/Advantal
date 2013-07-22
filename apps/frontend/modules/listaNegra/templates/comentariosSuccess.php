<div class="comentarios">
    <div class="list">
        <br />
        <?php if (count($comentarios) > 0) : ?>        
            <?php foreach ($comentarios as $k => $comentario): ?>
                <div class="item">
                    <div class="titulo"><strong style="color: #B41B1D">Comentario de <span style="color: #FF1919"><?php echo $comentario['username'] ?></span>
                            el <?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?>:</strong>
                    </div>
                    <div class="comentario" style="margin-bottom: 15px;">
                        <br/>
                        <?php
                        $result = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $comentario->getRaw('comentario'));
                        echo $result;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <a href="<?php echo url_for($url, array('slug' => $obj->getSlug())) ?>">ver +</a>
        <?php else : ?>
            <?php if ($sf_request->getParameter('tipo') == "empresa"): ?>
                <h2 style="font-size: 15px; color: #B41B1D; margin: 5px 0 0 22px !important;">Ningún colaborador ha comentado aún esta empresa o entidad. Si crees que merece un comentario <a title="Comenta una empresa o entidad no recomendada" class="login_required" href="<?php echo url_for('lista_negra_empresa_comenta', array('slug' => $empresas->getSlug()), array('dialog_id' => 'login_required')) ?>">¡comenta!</a></h2>
            <?php else: ?>
                <h2 style="font-size: 15px; color: #B41B1D; margin: 5px 0 0 22px !important;">Ningún colaborador ha comentado aún este producto. Si crees que merece un comentario <a title="Comenta un producto no recomendado" class="login_required" href="<?php echo url_for('lista_negra_producto_comenta', array('slug' => $productos->getSlug()), array('dialog_id' => 'login_required')) ?>">¡comenta!</a></h2>
            <?php endif; ?>
        <?php endif ?>
    </div>
</div>
<style type="text/css">
    .comentarios .login_required{
        color: #006400 !important;
    }
</style>
