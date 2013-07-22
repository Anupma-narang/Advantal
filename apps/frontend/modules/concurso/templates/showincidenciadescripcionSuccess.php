<div>
    <p><strong>Descripción de la incidencia:</strong></p>
    <?php print html_entity_decode($numero > 1 ? $contribucion->getIncidencia() : $concurso->getIncidencia()) ?>
</div>