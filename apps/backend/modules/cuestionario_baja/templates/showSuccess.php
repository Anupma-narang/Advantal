<div id="sf_admin_container">
    <h1>Cuestionario de baja de <?php echo $cuestionario[0]->getUser() ?></h1>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <table>
                <thead><tr><th width="50%">Pregunta</td><th>Respuesta</td></tr></thead>
                <tbody>
                    <?php foreach ($cuestionario as $c): ?><tr>
                        <tr>
                            <td><?php echo $c->getCuestionarioPregunta()->getLabel() ?></td>
                            <?php
                            $respuesta = $c->getValue();
                            if ($respuesta == 'off')
                                $respuesta = 'NO';
                            elseif ($respuesta == 'on')
                                $respuesta = 'SI';
                            ?>

                            <td><?php echo $respuesta ?></td>
                        </tr>
                    <?php endforeach; ?>		
                </tbody>
            </table>
        </div>
    </div>
</div>