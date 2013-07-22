<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1>Detalle de la carta de desaprobación</h1>
    <div id="sf_admin_content">
        <?php include_partial('cartas_desaprobacion/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('cartas_desaprobacion/list_header') ?>
        </div>


        <div id="profesional_actions" style="float: right">
            <?php
            include_partial("cartas_desaprobacion/actions", array(
                "concurso" => $concurso,
                "helper" => $helper,
            ))
            ?>
        </div>

        <h2>
            <?php echo __($concurso->last_name_one . " " . $concurso->last_name_two . ", " . $concurso->first_name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><strong>Fecha: </strong><?php echo format_datetime($concurso->getCreatedAt(), "dd/MM/y", "es_ES") ?></li>
            <li><strong>Estado:</strong> <?php echo $concurso->ProfesionalLetterEstado->name ?></li>
            <li><strong>Usuario: </strong><?php echo $concurso->User->username ?></li>

            <!-- <?php //if ($concurso->getFechaActivacion()):                          ?>
                 <li>Fecha de activación: <?php //echo format_datetime($concurso->fecha_activacion, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaReferendum()): ?>
                 <li>Fecha de Referéndum: <?php //echo format_datetime($concurso->fecha_referendum, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaDeliberacion()): ?>
                 <li>Fecha de Deliberación: <?php //echo format_datetime($concurso->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaObservacion()): ?>
                 <li>Fecha de Observación: <?php //echo format_datetime($concurso->fecha_observacion, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaCerrado()): ?>
                 <li>Fecha cerrado: <?php //echo format_datetime($concurso->fecha_cerrado, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaRechazado()): ?>
                 <li>Fecha rechazado: <?php //echo format_datetime($concurso->fecha_rechazado, "HH:mm dd/MM/y", "es_ES")                          ?>
                 </li>
            <?php //endif; ?>
            <?php //for ($i = 0; $i <= 10; $i++): ?>
            <?php //if (isset($arr_cambios_estados_revisiones[$i])): ?>
                     <li>Fecha de Revisión: <?php //echo format_datetime($arr_cambios_estados_revisiones[$i], "HH:mm dd/MM/y", "es_ES")                          ?></li>
            <?php //endif ?>
            <?php //if (isset($arr_cambios_estados_reactivaciones[$i])): ?>
                     <li>Fecha de reactivación: <?php //echo format_datetime($arr_cambios_estados_reactivaciones[$i], "HH:mm dd/MM/y", "es_ES")                          ?></li>
            <?php //endif ?>
            <?php //endfor ?>-->



            <li><strong>Tipo de carta:</strong> <?php echo $concurso->ProfesionalLetterType->name ?></li>
            <li><strong>Nombre: </strong><?php echo $concurso->Profesional->first_name; ?></li>
            <li><strong>Apellido 1: </strong><?php echo $concurso->Profesional->last_name_one; ?></li>
            <li><strong>Apellido 2: </strong><?php echo $concurso->Profesional->last_name_two; ?></li>
            <?php if (($concurso->States->name != "Toda España" && $concurso->Profesional->getRoadTypeId()) || ($concurso->States->name == "Toda España" && $concurso->Profesional->getRoadTypeId())): ?>
                <li><strong>Tipo de vía:</strong> <?php echo $concurso->Profesional->RoadType->name ?></li>
            <?php endif; ?>
            <?php if (($concurso->States->name != "Toda España" && $concurso->Profesional->address) || ($concurso->States->name == "Toda España" && $concurso->Profesional->address)): ?>
                <li><strong>Dirección: </strong><?php echo $concurso->Profesional->address . ($concurso->Profesional->numero ? ', Nº: ' . $concurso->Profesional->numero : '') . ($concurso->Profesional->piso ? ', Piso: ' . $concurso->Profesional->piso : '') . ($concurso->Profesional->puerta ? ', Puerta: ' . $concurso->Profesional->puerta : '') ?>
                </li>
            <?php endif; ?>
            <li><strong>Provincia: </strong><?php echo $concurso->States->name ?></li>
            <li><strong>Localidad: </strong><?php echo $concurso->getCity()->getName() ?></li>

            <?php if ($concurso->Profesional->telefono != ''): ?>
                <li><strong>Teléfono: </strong><?php echo $concurso->Profesional->telefono ?></li>
            <?php endif; ?>
            <?php if ($concurso->Profesional->email != ''): ?>
                <li><strong>Correo electrónico: </strong><?php echo $concurso->Profesional->email ?></li>
            <?php endif; ?>
            <li><strong>Sector: </strong><?php echo $concurso->Profesional->getProfesionalTipoUno()->getName() ?></li>
            <li><strong>Subsector: </strong><?php echo $concurso->Profesional->getProfesionalTipoDos()->getName() ?></li>
            <?php if ($concurso->Profesional->getProfesionalTipoTresId()): ?>
                <li><strong>Actividad: </strong>
                    <?php echo $concurso->Profesional->getProfesionalTipoTres(); ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaNulo()): ?>
                <li><strong>Fecha anulado: </strong><?php echo format_datetime($concurso->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?></li>
            <?php endif; ?>
            <br>
            <li><strong>Desaprobación:</strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($concurso->description) ?>
                <div style="clear:both; height: 16px;"></div>
                <span class="ver_link">  
                    <?php echo link_to('ver +', 'cartas_desaprobacion/showIncidencia?id=' . $concurso->getId(), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200")));                //echo '&nbsp;'.link_to('descargar pdf', 'cartas_pendientes/download_r_pdf?id=' . $concurso->getId());   ?>
                </span>             
            </li>
            <?php if ($concurso->plan_accion): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Plan de acción: </strong>
                    <p class="mr-span"> </p>
                    <?php echo html_entity_decode($concurso->plan_accion) ?>
                    <div style="clear:both; height: 16px;"></div>
                    <span class="ver_link">  
                        <?php echo link_to('ver +', 'cartas_desaprobacion/showPlanAccion?id=' . $concurso->getId(), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200"))) ?>
                    </span>
                </li>
            <?php endif ?>
            <?php if (count($concurso->getProfesionalLetterArchivo()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Archivos:</strong>
                    <ul>
                        <?php
                        $c = 1;
                        foreach ($concurso->getProfesionalLetterArchivo() as $a) {
                            if ($a->getFile()) {
                                $t = explode(".", $a->getFile());
                                echo '<li><a href="/images/uploads/documents/' . $a->getFile() . '">Archivo' . $c . '.' . end($t) . '</a></li>';
                            }
                            $c++;
                        }
                        ?></ul>
                </li><?php endif; ?>
        </ul>

        <?php if ($concurso->getProfesionalLetterEstadoId() == 1): ?>
            <form id="Puntos_form" action="<?php echo url_for('cartas_desaprobacion/changeStatus?id=' . $concurso->getId()) ?>" method="get">
                <input type="hidden" name="estado" value="2">
                <input type="hidden" name="siguiente" value="0" id="Siguiente">
            </form>
        <?php endif; ?>

        <style type="text/css">
            .ver_link{ float:left;margin: 0px 0px 5px -19px; }
        </style>
