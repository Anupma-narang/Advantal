<?php use_stylesheet('caja.css') ?>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'empresa'); ?>

            <?php echo link_to('Empresa / Entidad', url_for('concurso-misauditorias', $param), array('class' => ($audit_type == 'producto' ? '' : 'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'producto'); ?>
            <?php echo link_to('Producto', url_for('concurso-misauditorias', $param), array('class' => ($audit_type == 'producto' ? 'active' : ''))) ?>
        </span>
    </div>
</div>

<div id="content_concursos">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <div class="audit-block">

                    <div class="main cuestionario">
                        <h3>Cuestionario de la empresa <strong><?php echo $audit_object->getName() ?></strong></h3>


                        <?php if ($form->hasErrors()): ?>
                            <div class="form_row_error">
                                <p>Para auditar necesitas <strong>dar tu opinión en todas la preguntas</strong>.</p>
                            </div>
                        <?php endif; ?>

                        <?php echo $form->renderHiddenFields() ?>

                        <div class='preguntas'>

                            <?php foreach ($form['Preguntas'] as $pregunta) : ?>
                                <?php echo $pregunta->render(); ?>
                            <?php endforeach ?>
                            <div id="error_max_length" class="form_row_error" style="display:none">
                                <p>Has superado el espacio permitido para tus comentarios</p>
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
    <?php echo link_to('vuelve a mis auditorías', url_for('concurso-misauditorias', array('page' => $page, 'type' => $audit_type))) ?>
</div>
