<?php use_helper('Text') ?>
<?php use_javascript('fancybox/jquery.fancybox.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="sf_admin_container">
    <h1>Detalle del profesional</h1>

    <div id="sf_admin_content">
        <?php include_partial('profesionalLista/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('profesionalLista/list_header') ?>
        </div>


        <div id="profesional_actions" style="float: right">
            <?php
            include_partial("profesionalLista/actions", array(
                "profesional" => $profesional,
                "helper" => $helper,
                'n_profesional_destacados' => $n_profesional_destacados,
                'n_profesional_destacados_tiempo' => $n_profesional_destacados_tiempo
            ))
            ?>
        </div>

        <h2>
<?php echo __($profesional->last_name_one." ".$profesional->last_name_two.", ".$profesional->first_name, array(), 'messages') ?>
        </h2>
        <ul>
            <li>Fecha: <?php echo format_datetime($profesional->getCreatedAt(), "HH:mm dd/MM/y", "es_ES") ?>
            </li>
<?php if ($profesional->getFechaActivacion()): ?>
                <li>Fecha de activación: <?php echo format_datetime($profesional->fecha_activacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
<?php if ($profesional->getFechaReferendum()): ?>
                <li>Fecha de Referéndum: <?php echo format_datetime($profesional->fecha_referendum, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
<?php if ($profesional->getFechaDeliberacion()): ?>
                <li>Fecha de Deliberación: <?php echo format_datetime($profesional->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
<?php if ($profesional->getFechaObservacion()): ?>
                <li>Fecha de Observación: <?php echo format_datetime($profesional->fecha_observacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
<?php if ($profesional->getFechaCerrado()): ?>
                <li>Fecha cerrado: <?php echo format_datetime($profesional->fecha_cerrado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
<?php if ($profesional->getFechaRechazado()): ?>
                <li>Fecha rechazado: <?php echo format_datetime($profesional->fecha_rechazado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php for ($i = 0; $i <= 10; $i++): ?>
                <?php if (isset($arr_cambios_estados_revisiones[$i])): ?>
                    <li>Fecha de Revisión: <?php echo format_datetime($arr_cambios_estados_revisiones[$i], "HH:mm dd/MM/y", "es_ES") ?></li>
                <?php endif ?>
                <?php if (isset($arr_cambios_estados_reactivaciones[$i])): ?>
                    <li>Fecha de reactivación: <?php echo format_datetime($arr_cambios_estados_reactivaciones[$i], "HH:mm dd/MM/y", "es_ES") ?></li>
                <?php endif ?>
<?php endfor ?>
            <li>Usuario: <?php echo $profesional->first_name->User ?>
            </li>
            <li>Estado: <?php echo $profesional->ProfesionalEstado->name ?>
            </li>
            <li>Provincia: <?php echo $profesional->States->name ?>
            </li>
            <li>Localidad: <?php echo $profesional->getCity()->getName() ?>
            </li>
            <li>Tipo de vía: <?php echo $profesional->RoadType->name ?>
            </li>
            <li>Dirección: <?php echo $profesional->address ?>, Nº: <?php echo $profesional->numero ?>, <?php echo $profesional->piso ? 'Piso:' . $profesional->piso . ', ' : '' ?> <?php echo $profesional->puerta ? 'Puerta: ' . $profesional->puerta : '' ?>
            </li>
            <li>Actividad: <?php
    if (!$profesional->getProfesionalTipoTresId())
        echo $profesional->getProfesionalTipoDos();
    else
        echo $profesional->getProfesionalTipoTres();
    ?>
                </li>
<?php if ($profesional->getFechaNulo()): ?>
                <li>Fecha anulado: <?php echo format_datetime($profesional->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
       </ul>

<?php if ($profesional->getProfesionalEstadoId() == 1): ?>
            <div id="Asignacion_puntos_content">
                <h2>Asignación de puntos</h2>
                <div id="Asignacion_puntos_inner">
                    <form id="Puntos_form" action="<?php echo url_for('profesionalLista/changeStatus?id=' . $profesional->getId()) ?>" method="get">
                        <input type="hidden" name="estado" value="2">
                        <input type="hidden" name="siguiente" value="0" id="Siguiente">
                        <table>
                            <tbody>
                                <?php $c = 1 ?>
    <?php foreach ($puntos as $p): ?>
                                    <tr>
                                        <td><input type="checkbox" name="<?php echo $p->getCodigo() ?>"
                                                   value="true"></td>
                                        <td><?php echo $p->getDescripcion() ?></td>
                                        <td><strong><?php echo $p->puntos ?></strong></td>
                                    </tr>
                                    <?php $c++ ?>
    <?php endforeach; ?>
                                <tr>
                                    <th>Otro</th>
                                    <td><input type="text" name="otro_descripcion" size="40" id="Otro_descripcion"></td>
                                    <td><input type="text" name="otro_puntos" size="10" id="Otro_puntos"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($profesional->profesional_estado_id == 4): // Deliberación ?>
            <?php /*$results = $profesional->getReferendumResult() ?>
            <?php if (count($results)): ?>
                <br/>
                <h3>Resultado del profesional</h3>
                <table class="results">
                    <thead><tr><th>Puesto</th><th>Colaborador</th><th>Contribución</th><th>Puntos</th><th>Colaboradores que le han votado</th></tr></thead>
                    <tbody>
                    <?php
                        $count = 1;
                        foreach ($results as $r)
                        {
                            printf('<tr><td class="num">%s</td><td>%s</td><td>%s</td><td class="num">%s</td><td class="num">%s</td></tr>',
                                $count, $r['username'], link_to($r['contribucion_name'], "contribucion/show?id=".$r['contribucion_id']), $r['puntos'], $r['votos']);
                            $count = $count + 1;
                        }
                    ?>
                    </tbody>
                </table>
            <?php endif; */?>
        <?php endif; ?>


