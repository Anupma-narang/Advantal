<?php use_stylesheet('caja.css') ?>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'empresa'); ?>

            <?php echo link_to('Empresa / Entidad', url_for('concurso-miscomentarios', $param), array('class' => ($comment_type == 'producto' ? '' : 'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'producto'); ?>
            <?php echo link_to('Producto', url_for('concurso-miscomentarios', $param), array('class' => ($comment_type == 'producto' ? 'active' : ''))) ?>
        </span>
    </div>
</div>

<div id="content_concursos">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <div class="comment-block">

                    <div class="main cuestionario">
                        <h3>Cuestionario de la empresa <strong><?php echo $comment_object->getName() ?></strong></h3>
                        <?php echo $form->renderHiddenFields(); ?>
                        <?php if ($form->hasErrors()): ?>
                            <div class="form_row_error">
                                <p>Necesitas introducir un comentario.</p>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?php echo $form['comentario']->render() ?>
                            <div id="error_max_length" class="form_row_error" style="display:none">
                                <p>Has superado el espacio permitido para tu comentario</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>


</div>
<div class="float-left">
    <?php echo link_to('vuelve a mis comentarios', url_for('concurso-miscomentarios', array('page' => $page, 'type' => $comment_type))) ?>
</div>
