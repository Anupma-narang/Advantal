<?php use_helper('Text') ?>      
<div id="content_concursos">
    <div id="content_concursos_arriba2"> Detalle de Comunidad </div>
    <div id="show_detalle_concurso">
        <p align="center"><?php echo $concurso->name ?></p>
        <p><?php echo truncate_text("INCIDENCIA DEL CONCURSO:" . $concurso->incidencia, $length = 380) ?> </p>
        <p><?php echo "Estado de concurso: " . $concurso->ConcursoEstado->name ?></p>
        <p> <?php echo "Tipo Concurso: " . $concurso->ConcursoTipo->name ?> &nbsp;</p>
    </div>

    <div id="content_concursos_arriba2">Contribuciones Comunidad
    </div>
    <p>&nbsp;</p>
    <?php foreach ($concurso->ContribucionCp as $i => $contribucion): ?>
        <?php include_partial("comunidadprivada/contribucioncp", array("contribucioncp" => $contribucion, "orden" => $i)) ?>
    <?php endforeach; ?>

    <p>&nbsp;</p>

</div>