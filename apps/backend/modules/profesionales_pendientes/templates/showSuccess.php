<?php use_helper('Text') ?>
<?php include_partial('assets') ?>
<?php
use_javascript('https://maps.google.com/maps/api/js?sensor=false');
use_javascript('sf_widget_gmap_address.js');
?>

<div id="sf_admin_container">
    <h1>Detalle del profesional pendiente</h1>

    <div id="sf_admin_content">
        <?php include_partial('profesionales_pendientes/flashes') ?>
        <div id="sf_admin_header">
            <?php include_partial('profesionales_pendientes/list_header') ?>
        </div>
        <div id="concurso_actions" style="float: right">
            <?php
            include_partial("profesionales_pendientes/actions", array(
                "profesional" => $profesional,
                "helper" => $helper,
                'n_profesional_destacados' => $n_profesional_destacados,
                'n_profesional_destacados_tiempo' => $n_profesional_destacados_tiempo,
                'profesionalRecomenda' => $profesionalRecomenda,
                'letterCount' => $letterCount
            ))
            ?>
        </div>
        <h2>
            <?php echo __($profesional->last_name_one . " " . $profesional->last_name_two . ", " . $profesional->first_name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><strong>Fecha: </strong><?php echo format_datetime($profesional->getCreatedAt(), "dd/MM/y", "es_ES") ?>
            </li>
            <li><strong>Estado: </strong><?php echo $profesional->ProfesionalEstado->name ?></li>
            <li><strong>Usuario: </strong><?php echo $profesional->User ?></li>
            <?php if ($profesional->getFechaRevision()): ?>
                <li><strong>Fecha de revisión: </strong><?php echo format_datetime($profesional->fecha_revision, "HH:mm dd/MM/y", "es_ES") ?>
                <?php endif; ?>
                <?php if ($profesional->getFechaActivacion()): ?>
                <li><strong>Fecha de activación: </strong><?php echo format_datetime($profesional->fecha_activacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($profesional->getFechaReferendum()): ?>
                <li><strong>Fecha de Referéndum: </strong><?php echo format_datetime($profesional->fecha_referendum, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($profesional->getFechaDeliberacion()): ?>
                <li><strong>Fecha de Deliberación: </strong><?php echo format_datetime($profesional->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($profesional->getFechaCerrado()): ?>
                <li><strong>Fecha cerrado: </strong><?php echo format_datetime($profesional->fecha_cerrado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($profesional->getFechaRechazado()): ?>
                <li><strong>Fecha rechazado: </strong><?php echo format_datetime($profesional->fecha_rechazado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($profesional->getFechaNulo()): ?>
                <li><strong>Fecha anulado: </strong><?php echo format_datetime($profesional->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>

            <li><strong>Nombre: </strong><?php echo $profesional->first_name ?> </li>
            <li><strong>Apellido 1: </strong><?php echo $profesional->last_name_one ?> </li>
            <li><strong>Apellido 2: </strong><?php echo $profesional->last_name_two ?> </li>
            <?php if (($profesional->getStates() != "Toda España" && $profesional->getRoadTypeId()) || ($profesional->getStates() == "Toda España" && $profesional->getRoadTypeId())): ?>
                <li><strong>Tipo de vía:</strong> <?php echo $profesional->RoadType->name ?></li>
            <?php endif; ?>

            <?php if (($profesional->getStates() != "Toda España" && $profesional->address) || ($profesional->getStates() == "Toda España" && $profesional->address)): ?>
                <li><strong>Dirección: </strong>
                    <?php echo $profesional->address . ($profesional->numero ? ', Nº: ' . $profesional->numero : '') . ($profesional->piso ? ', Piso: ' . $profesional->piso : '') . ($profesional->puerta ? ', Puerta: ' . $profesional->puerta : '') ?>
                </li>
            <?php endif; ?>

            <li><strong>Provincia: </strong><?php echo $profesional->States->name; ?></li>
            <li><strong>Localidad: </strong><?php echo $profesional->getCity()->getName() ?></li>
            <?php if ($profesional->telefono != ''): ?>
                <li><strong>Teléfono: </strong><?php echo $profesional->telefono ?></li>
            <?php endif; ?>
            <?php if ($profesional->email != ''): ?>
                <li><strong>Correo electrónico: </strong><?php echo $profesional->email ?></li>
            <?php endif; ?>
            <li><strong>Sector: </strong><?php echo $profesional->getProfesionalTipoUno()->getName() ?></li>
            <li><strong>Subsector: </strong><?php echo $profesional->getProfesionalTipoDos()->getName() ?></li>

            <?php if ($profesional->getProfesionalTipoTresId()): ?>
                <li><strong>Actividad: </strong>
                    <?php echo $profesional->getProfesionalTipoTres(); ?>
                </li>
            <?php endif; ?>
            <br/>
            <li><strong>Recomendación:</strong>
                <p class="mr-span"> </p>
                <div class="recomendacion"><?php echo html_entity_decode($profesionalRecomenda->getDescription()); ?></div>
                <div style="clear:both;height:16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', url_for('profesionales_pendientes/showRecomendation?id=' . $profesionalRecomenda->getId()), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200, menubar=1"))); ?>
                </span>
            </li>
        </ul>
        <div style="clear:both; height: 29px;"></div>
        <div>
            <?php echo $activeReasonForm->renderFormTag(url_for('profesionales_pendientes/show?form=submit'), array('method' => 'POST', 'id' => 'profesional_reason')) ?>
            <?php if ($activeReasonForm['active_reason']->hasError()): ?>
                <div><ul class="error_list"><li><?php echo $activeReasonForm['active_reason']->getError() ?></li></ul></div>
            <?php endif; ?>
            <div id="Error_max_length_incidencia" style="display:none">
                <ul  class="error_list">
                    <li>Has superado el espacio permitido para los Indicadores de excelencia.</li>
                </ul>
            </div>
            <table>
                <tr>
                    <td><?php echo $activeReasonForm['active_reason']->renderLabel(); //echo __('Indicadores de excelencia')                         ?>
                        <input type="hidden" value="<?php echo $sf_params->get('id') ?>" name="id">
                        <input type="hidden" name="siguiente" value="0" id="Siguiente">
                    </td>
                    <td><br>
                        <?php echo $activeReasonForm['active_reason']->render() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $activeReasonForm['profesionalGoogleMap']->renderLabel(); ?></td>
                    <td> <div class="content">
                            <?php echo $activeReasonForm['profesionalGoogleMap']->render(); ?></div></td>
                </tr>
            </table>
            </form>
        </div>
        <ul class='sf_admin_actions' style="margin: 10px 10px 10px 0px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver a profesionales pendientes', '@profesionales_pendientes', array('class' => 'sf_admin_action_cancel')) ?></li>
            <!--li class='sf_admin_action_list'><?php //echo link_to('Volver a profesional en lista', '@profesional_profesionalesListaBlanca', array('class' => 'sf_admin_action_cancel'))                         ?></li-->
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', "profesionales_pendientes/edit?id=" . $profesional->id) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .ver_link{ float:left;margin: 0px 0px 5px -19px; }
    .recomendacion ol {margin: 0 0 0 20px;}
    .recomendacion ol li {margin: 0 !important;}
    .recomendacion ul {margin: 0 0 0 15px;}
    .recomendacion ul li {margin: 0 !important; }
    .recomendacion ul li a{background: none !important;padding: 0 !important;}
</style>
<?php if ($sf_user->hasFlash('errorDuplicate')): ?>
    <script type="text/javascript" >
        alert('<?php echo $sf_user->getFlash('errorDuplicate'); ?>');
    </script>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        var msg = $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list li").html();
        $("div.content div.error").html("Para publicar un profesional necesitas asociarle una ubicación.");
        $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list").hide();
    });
</script>