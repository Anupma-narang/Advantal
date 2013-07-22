<div id="sf_admin_container">
    <h1>Detalle de la pregunta de baja</h1>


    <div id="sf_admin_content">
        <table>
            <thead><tr><th>Creada el</th><th>Pregunta</th><th>Tipo de pregunta</th></tr></thead>
            <tbody>
                <tr>
                    <td><?php echo format_datetime($pregunta->getCreatedAt(), "dd/MM/y HH:mm", "es_ES") ?></td>
                    <td><?php echo $pregunta->getLabel() ?></td>
                    <td><?php echo $pregunta->getCuestionarioValuesTypes() ?></td>
                </tr>
            </tbody>
        </table>  
    </div>
    <div class="volver_al_listado123">
        <?php echo link_to('Volver al Listado', 'cuestionario_pregunta/index') ?>
    </div>    
</div>