<?php use_helper('Date', 'Text', 'Concursos') ?>
<div id="content_concursos_arriba2">Contribuciones</div>
<?php foreach($contribution_records as $index => $contribucion):?>
<div id="contribucion<?php echo $destacada ? '_destacada' : ''  ?>_top">
    <a name="contribucion<?php echo $contribucion->getId()?>"></a>
    <div id="contribucion_title">
        <p id="contribucion_<?php echo $contribucion->numero ?>">
            <?php //if (!$destacada) echo $contribucion->name; else echo __('RESUMEN DEL PLAN DE ACCIÓN'); ?>
            <?php echo $contribucion->name ?>
        </p>
    </div>
</div>
<div id="contribucion<?php echo $destacada ? '_destacada' : ''  ?>_middle">
    <?php if (!$destacada): ?>
    <div class="datos_creacion">
        <?php echo format_datetime($contribucion->created_at, 'p', 'es_ES') ?>
        <br/>
        <?php echo $contribucion->ownsToUser() ? __('Creada por ti') :__('Creada por: %%username%%',array('%%username%%' => $contribucion->getUser()->getUserName())) ?>
    </div>
    <?php endif; ?>

    <?php if (!$destacada): ?>
        <div class="descripcion">
            Descripción de la incidencia:
            <?php echo html_truncate(530, html_entity_decode($contribucion->incidencia), link_to(__('ver +'), url_for_incidencia($contribucion), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')))) ?>
        </div>
    <?php endif; ?>

    <div id="resumen_voto_contribucion">
        Resumen del plan de acción:
        <?php echo html_entity_decode($contribucion->resumen) ?>
    </div>

    <?php if ($contribucion->getConcurso()->concurso_estado_id==3): ?>
        <?php if (!$destacada or ($destacada and $page==1)): ?>
            <?php include_component('concurso', 'votacion', array('contribucion'=>$contribucion)) ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($destacada): ?>
        <?php include_partial("concurso/ficheros", array('user_id' => $contribucion->getUserId(), 'ficheros' => $contribucion->getConcurso()->getArchivos())) ?>
    <?php else: ?>
        <hr class="clear">
        <?php include_partial("concurso/ficheros", array('user_id' => $contribucion->getUserId(), 'ficheros' => $contribucion->getArchivos())) ?>
    <?php endif; ?>

    <?php if (!$destacada): ?>
        <?php //echo link_to_contribuye($contribucion) ?>
        <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to_concurso($concurso); ?></span></div>
    <?php endif; ?>

    <?php if($contribucion->ownsToUser()):?>
        <div style="clear: both; text-align: right; margin: 0px 30px;">
            <?php echo link_to(__('ver Plan de acción'), url_for_plan_accion($contribucion),array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0'))) ?>
            <?php echo link_to('descargar pdf', 'contribucionuno/download_pdf?id=' . $contribucion->getId()) ?>
        </div>
    <?php endif; ?>
</div>
<div id="contribucion<?php echo $destacada ? '_destacada' : ''  ?>_bot"></div>
<?php endforeach;?>