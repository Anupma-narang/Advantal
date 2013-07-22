<?php use_helper('Text', 'Concursos') ?>
<div>
    <p><strong>Descripción de la incidencia:</strong></p>
    <?php print html_truncate(2800, html_entity_decode($contribucion->incidencia), link_to(__('ver +'), url_for_incidencia($contribucion), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')))) ?>

    <p><strong>Resumen del plan de acción:</strong></p>
    <?php print truncate_text(html_entity_decode($contribucion->resumen), $length = 1100, '...', true) ?>

    <?php if (in_array($contribucion->Concurso->ConcursoEstado->value, array(2,10))): ?>
        <div id="boton_contribuye" class="texto_contribuye">
            <?php print link_to_contribuye($contribucion, '') ?>
        </div>
    <?php elseif ($contribucion->Concurso->ConcursoEstado->value == 3): ?>
        <div style="color:black">
            <?php if ($contribucion->Concurso->concurso_estado_id == 3): ?>
                <?php include_component('concurso', 'votacion', array('contribucion'=>$contribucion)) ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div id="boton_contribuye" class="align_ver_detalle">
        <?php print link_to_concurso($contribucion->getConcurso()) ?>
    </div>
</div>
<?php include_partial('global/login_required') ?>