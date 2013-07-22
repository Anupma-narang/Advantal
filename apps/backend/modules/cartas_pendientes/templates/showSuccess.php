<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1>Detalle de la carta pendiente</h1>

    <div id="sf_admin_content">
        <?php include_partial('cartas_pendientes/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('cartas_pendientes/list_header') ?>
        </div>


        <div id="cartas_actions" style="float: right">
            <?php
            include_partial("cartas_pendientes/actions", array(
                "cartas" => $cartas,
                "helper" => $helper,
            ))
            ?>
        </div>

        <h2>
            <?php echo __($cartas->name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><strong>Fecha:</strong> <?php echo format_datetime($cartas->getCreatedAt(), "dd/MM/y", "es_ES") ?></li>
            <li><strong>Estado: </strong><?php echo $cartas->ProfesionalLetterEstado->name ?></li>
            <li><strong>Usuario: </strong><?php echo $cartas->User ?></li>
            <?php if ($cartas->getFechaRevision()): ?>
                <li><strong>Fecha de revisión:</strong> <?php echo format_datetime($cartas->fecha_revision, "HH:mm dd/MM/y", "es_ES") ?>
                <?php endif; ?>
                <?php if ($cartas->getFechaActivacion()): ?>
                <li><strong>Fecha de activación:</strong> <?php echo format_datetime($cartas->fecha_activacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($cartas->getFechaReferendum()): ?>
                <li><strong>Fecha de Referéndum:</strong> <?php echo format_datetime($cartas->fecha_referendum, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($cartas->getFechaDeliberacion()): ?>
                <li><strong>Fecha de Deliberación:</strong> <?php echo format_datetime($cartas->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($cartas->getFechaCerrado()): ?>
                <li><strong>Fecha cerrado:</strong> <?php echo format_datetime($cartas->fecha_cerrado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($cartas->getFechaRechazado()): ?>
                <li><strong>Fecha rechazado:</strong> <?php echo format_datetime($cartas->fecha_rechazado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($cartas->getFechaNulo()): ?>
                <li><strong>Fecha anulado:</strong> <?php echo format_datetime($cartas->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <li><strong>Nombre: </strong><?php echo $cartas->Profesional->first_name; ?></li>
            <li><strong>Apellido 1: </strong><?php echo $cartas->Profesional->last_name_one; ?></li>
            <li><strong>Apellido 2: </strong><?php echo $cartas->Profesional->last_name_two; ?></li>
            <li><strong>Tipo de carta:</strong> <?php echo $cartas->ProfesionalLetterType->name ?>
            </li>
            <?php if (($cartas->getStates() != "Toda España" && $cartas->Profesional->getRoadTypeId()) || ($cartas->getStates() == "Toda España" && $cartas->Profesional->getRoadTypeId())): ?>
                <li><strong>Tipo de vía:</strong> <?php echo $cartas->Profesional->RoadType->name ?></li>
            <?php endif; ?>
            <?php if (($cartas->getStates() != "Toda España" && $cartas->Profesional->address) || ($cartas->getStates() == "Toda España" && $cartas->Profesional->address)): ?>
                <li>
                    <strong>Dirección: </strong>
                    <?php echo $cartas->Profesional->address . ($cartas->Profesional->numero ? ', Nº: ' . $cartas->Profesional->numero : '') . ($cartas->Profesional->piso ? ', Piso: ' . $cartas->Profesional->piso : '') . ($cartas->Profesional->puerta ? ', Puerta: ' . $cartas->Profesional->puerta : '') ?>
                </li>
            <?php endif; ?>
            <li><strong>Provincia: </strong> <?php echo $cartas->States->name; ?></li>
            <li><strong>Localidad:</strong> <?php echo $cartas->City->name; ?></li>
            <?php if ($cartas->Profesional->telefono != ''): ?>
                <li><strong>Teléfono: </strong><?php echo $cartas->Profesional->telefono ?></li>
            <?php endif; ?>

            <?php if ($cartas->Profesional->email != ''): ?>
                <li><strong>Correo electrónico: </strong><?php echo $cartas->Profesional->email ?></li>
            <?php endif; ?>

            <li><strong>Sector: </strong><?php echo $cartas->Profesional->getProfesionalTipoUno()->getName() ?></li>

            <li><strong>Subsector: </strong><?php echo $cartas->Profesional->getProfesionalTipoDos()->getName() ?></li>

            <?php if ($cartas->getProfesional()->getProfesionalTipoTres()->getName() != ''): ?>
                <li><strong>Actividad: </strong><?php echo $cartas->Profesional->ProfesionalTipoTres->name; ?></li>
            <?php endif; ?>
            <br/>
            <li><strong><?php echo $cartas->ProfesionalLetterType->name ?>:</strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($cartas->description) ?>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'cartas_pendientes/showIncidencia?id=' . $cartas->getId(), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200, menubar=1"))); ?>
                </span>
            </li>
            <?php if ($cartas->ProfesionalLetterType->name == 'Desaprobación'): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Plan de acción: </strong>
                    <p class="mr-span"> </p>
                    <?php echo html_entity_decode($cartas->plan_accion) ?>
                    <span class="ver_link">
                        <?php echo '<br/>' . link_to('ver +', 'cartas_pendientes/showPlanAccion?id=' . $cartas->getId(), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200, menubar=1"))) ?>
                    </span>
                </li>
            <?php endif ?>
            <?php if (count($cartas->getProfesionalLetterArchivo()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Archivos:</strong>
                    <ul>
                        <?php
                        $c = 1;
                        foreach ($cartas->getProfesionalLetterArchivo() as $a) {
                            if ($a->getFile()) {
                                $t = explode(".", $a->getFile());
                                echo '<li><a href="/images/uploads/documents/' . $a->getFile() . '">Archivo' . $c . '.' . end($t) . '</a></li>';
                            }
                            $c++;
                        }
                        ?></ul>
                </li><?php endif; ?>

        </ul>

        <?php if ($cartas->getProfesionalLetterEstadoId() == 1): ?>
            <!--<div id="Asignacion_puntos_content">-->
            <!--<h2>Asignación de puntos</h2>-->
            <!--<div id="Asignacion_puntos_inner">-->
            <form id="Puntos_form" action="<?php echo url_for('cartas_pendientes/changeStatus?id=' . $cartas->getId()) ?>" method="get">
                <input type="hidden" name="estado" value="2">
                <input type="hidden" name="siguiente" value="0" id="Siguiente">
                <!--<table>-->
                <!--<tbody>-->
                <?php //$c = 1 ?>
                <?php //foreach ($puntos as $p): ?>
                <!--<tr>-->
                        <!--<td><input type="checkbox" name="<?php //echo $p->getCodigo()                ?>" value="true"></td>-->
                        <!--<td><?php //echo $p->getDescripcion()                ?></td>-->
                        <!--<td><strong><?php //echo $p->puntos               ?></strong></td>-->
                </tr>
                <?php //$c++ ?>
                <?php //endforeach; ?>
                <!--<tr>
                        <th>Otro</th>
                        <td><input type="text" name="otro_descripcion" size="40" id="Otro_descripcion"></td>
                        <td><input type="text" name="otro_puntos" size="10" id="Otro_puntos"></td>
                </tr>
                </tbody>
                </table>-->
            </form>
            <!--</div>-->
            <!--</div>-->
        <?php endif; ?>

        <?php /* if ($cartas->profesional_letter_estado_id == 4): // Deliberación ?>
          <?php $results = $cartas->getReferendumResult() ?>
          <?php if (count($results)): ?>
          <br/>
          <h3>Resultado del Profesionales</h3>
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
          <?php endif; ?>
          <?php endif; */ ?>
        <style type="text/css">
            #sf_admin_theme_footer{ clear: both;}
            .ver_link{ float:left;margin: 0px 0px 5px -19px; }
        </style>