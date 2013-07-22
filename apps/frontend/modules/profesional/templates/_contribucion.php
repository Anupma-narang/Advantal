<?php use_helper('Date', 'Text', 'Concursos') ?>
<div id="contribucionSmall<?php print $destacada ? '_destacada' : ''  ?>_top">
    <a name="contribucion<?php print $contribucion->getId() ?>"></a>
    <div id="contribucion_title">
        <p id="contribucion_<?php print $contribucion->first_name ?>">
            <?php //if (!$destacada) print $contribucion->name; else print __('RESUMEN DEL PLAN DE ACCIÓN'); ?>
            <?php print $contribucion->first_name ?>
        </p>
    </div>
</div>
<div id="contribucionSmall<?php print $destacada ? '_destacada' : ''  ?>_middle">
    <?php if (!$destacada): ?>
        <div class="datos_creacion">
            <?php echo format_datetime($contribucion->created_at, 'p', 'es_ES') ?>
            <br/>
            <?php print $contribucion->ownsToUser() ? __('Creada por ti') : __('Creada por: %%username%%', array('%%username%%' => $contribucion->getUser()->getUserName()))  ?>
        </div>
    <?php endif; ?>

    <?php if (!$destacada): ?>
        <div class="descripcion">
            Descripción de la incidencia:
            <?php print html_truncate(530, html_entity_decode($contribucion->incidencia), link_to(__('ver +'), url_for_incidencia($contribucion), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')))) ?>
        </div>
    <?php endif; ?>

    <div id="resumen_voto_contribucion">
        Resumen del plan de acción:
        <?php print html_entity_decode($contribucion->first_name) ?>
    </div>

    <?php if ($destacada): ?>
        <?php include_partial("profesional/ficheros", array('user_id' => $contribucion->getUserId(), 'ficheros' => $contribucion->getDestacadosPorSectorAndLocalidad())) ?>
    <?php else: ?>
        <hr class="clear">
        <?php include_partial("profesional/ficheros", array('user_id' => $contribucion->getUserId(), 'ficheros' => $contribucion->getDestacadosPorSectorAndLocalidad())) ?>
    <?php endif; ?>

    <?php if (!$destacada): ?>
        <?php print link_to_contribuye($contribucion) ?>
    <?php endif; ?>

    <?php //if($contribucion->ownsToUser()):?>
    <div style="clear: both; text-align: right; margin: 0px 30px;">
        <?php //print link_to(__('ver Plan de acción'), url_for_plan_accion($contribucion),array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0'))) ?>
        <?php //echo link_to('descargar pdf', 'contribucionuno/download_pdf?id=' . $contribucion->getId()) ?>
    </div>
    <?php //endif; ?>
</div>
<div id="contribucionSmall<?php print $destacada ? '_destacada' : ''  ?>_bot"></div>
