<?php use_helper('Text') ?>
<?php use_javascript('fancybox/jquery.fancybox.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="sf_admin_container">
    <h1>Detalle de la carta de recomendación</h1>

    <div id="sf_admin_content">
        <?php include_partial('cartas_recomendacion/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('cartas_recomendacion/list_header') ?>
        </div>


        <div id="profesional_actions" style="float: right">
            <?php
            include_partial("cartas_recomendacion/actions", array(
                "concurso" => $concurso,
                "helper" => $helper,
            ))
            ?>
        </div>

        <h2>
            <?php echo __($concurso->last_name_one . " " . $concurso->last_name_two . ", " . $concurso->first_name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><strong>Fecha: </strong><?php echo format_datetime($concurso->getCreatedAt(), "dd/MM/y", "es_ES") ?>
            </li>
            <li><strong>Estado:</strong> <?php echo $concurso->ProfesionalLetterEstado->name ?></li>
            <li><strong>Usuario: </strong><?php echo $concurso->User->username ?></li>
            <!-- <?php //if ($concurso->getFechaActivacion()):                 ?>
                 <li><strong>Fecha de activación: </strong><?php //echo format_datetime($concurso->fecha_activacion, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaReferendum()): ?>
                 <li><strong>Fecha de Referéndum: </strong><?php //echo format_datetime($concurso->fecha_referendum, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaDeliberacion()): ?>
                 <li><strong>Fecha de Deliberación: </strong><?php //echo format_datetime($concurso->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaObservacion()): ?>
                 <li><strong>Fecha de Observación: </strong><?php //echo format_datetime($concurso->fecha_observacion, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaCerrado()): ?>
                 <li><strong>Fecha cerrado: </strong><?php //echo format_datetime($concurso->fecha_cerrado, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //if ($concurso->getFechaRechazado()): ?>
                 <li><strong>Fecha rechazado: </strong><?php //echo format_datetime($concurso->fecha_rechazado, "HH:mm dd/MM/y", "es_ES")                 ?>
                 </li>
            <?php //endif; ?>
            <?php //for ($i = 0; $i <= 10; $i++): ?>
            <?php //if (isset($arr_cambios_estados_revisiones[$i])): ?>
                     <li><strong>Fecha de Revisión: </strong><?php //echo format_datetime($arr_cambios_estados_revisiones[$i], "HH:mm dd/MM/y", "es_ES")                 ?></li>
            <?php //endif ?>
            <?php //if (isset($arr_cambios_estados_reactivaciones[$i])): ?>
                     <li><strong>Fecha de reactivación: </strong><?php //echo format_datetime($arr_cambios_estados_reactivaciones[$i], "HH:mm dd/MM/y", "es_ES")                 ?></li>
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
                <li>
                    <strong>Dirección: </strong>
                    <?php echo $concurso->Profesional->address . ($concurso->Profesional->numero ? ', Nº: ' . $concurso->Profesional->numero : '') . ($concurso->Profesional->piso ? ', Piso: ' . $concurso->Profesional->piso : '') . ($concurso->Profesional->puerta ? ', Puerta: ' . $concurso->Profesional->puerta : '') ?>
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
            <br/>
            <li><strong>Recomendación:</strong>
                <p class="mr-span"> </p><?php echo html_entity_decode($concurso->description) ?>
                <div style="clear:both; height: 16px;"></div>
                <span class="ver_link">  
                    <?php echo link_to('ver +', 'cartas_recomendacion/showIncidencia?id=' . $concurso->getId(), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200"))); ?>
                </span>
            </li>

            <?php /* if(count($concurso->Profesional->getProfesionalArchivo())>0):?>
              <li><strong>Archivos:</strong>
              <ul>
              <?php
              $c=1;
              foreach($concurso->Profesional->getProfesionalArchivo() as $a){
              if($a->getFile()){
              $t = explode(".",$a->getFile());
              echo '<li><a href="/images/uploads/documents/'.$a->getFile().'">Archivo'.$c.'.'.end($t).'</a></li>';
              }
              $c++;
              }
              ?></ul>
              </li><?php endif; */ ?>


        </ul>

        <?php if ($concurso->getProfesionalLetterEstadoId() == 1): ?>
            <form id="Puntos_form" action="<?php echo url_for('cartas_recomendacion/changeStatus?id=' . $concurso->getId()) ?>" method="get">
                <input type="hidden" name="estado" value="2">
                <input type="hidden" name="siguiente" value="0" id="Siguiente">
            </form>
        <?php endif; ?>
        <style type="text/css">
            .ver_link{ float:left;margin: 0px 0px 5px -19px; }
        </style>