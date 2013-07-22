<?php use_helper('Text') ?>
<?php include_partial('assets') ?>
<?php
use_javascript('https://maps.google.com/maps/api/js?sensor=false');
use_javascript('sf_widget_gmap_address.js');
?>
<div id="sf_admin_container">
    <h1>Detalle del profesional</h1>
    <div id="sf_admin_content">
        <?php include_partial('profesionalLista/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('profesionalLista/list_header') ?>
        </div>

        <div id="profesionalLista_actions" style="float: right">
            <?php
            include_partial("profesionalLista/actions", array(
                "profesional" => $profesional,
                "helper" => $helper,
                'n_profesional_destacados' => $n_profesional_destacados,
                'n_profesional_destacados_tiempo' => $n_profesional_destacados_tiempo,
                'letterCount' => $letterCount
            ))
            ?>
        </div>
        <h2>
            <?php echo __($profesional->last_name_one . " " . $profesional->last_name_two . ", " . $profesional->first_name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><strong>Fecha: </strong><?php echo format_datetime($profesional->getCreatedAt(), "dd/MM/y", "es_ES") ?></li>
            <li><strong>Estado: </strong><?php echo $profesional->ProfesionalEstado->name ?></li>
            <li><strong>Usuario: </strong><?php echo $profesional->User ?></li>
            <li><strong>Nombre: </strong><?php echo $profesional->first_name ?> </li>
            <li><strong>Apellido 1: </strong><?php echo $profesional->last_name_one ?> </li>
            <li><strong>Apellido 2: </strong><?php echo $profesional->last_name_two ?> </li>
            <?php if (($profesional->getStates() != "Toda España" && $profesional->getRoadTypeId()) || ($profesional->getStates() == "Toda España" && $profesional->getRoadTypeId())): ?>
                <li><strong>Tipo de vía:</strong> <?php echo $profesional->RoadType->name ?></li>
            <?php endif; ?>
            <?php if (($profesional->getStates() != "Toda España" && $profesional->address) || ($profesional->getStates() == "Toda España" && $profesional->address)): ?>
                <li><strong>Dirección: </strong><?php echo $profesional->address . ($profesional->numero ? ', Nº: ' . $profesional->numero : '') . ($profesional->piso ? ', Piso: ' . $profesional->piso : '') . ($profesional->puerta ? ', Puerta: ' . $profesional->puerta : '') ?>
                </li>
            <?php endif; ?>
            <li><strong>Provincia: </strong><?php echo $profesional->States->name ?></li>
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
            <?php if ($profesional->getFeatured() > 0): ?>
                <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                <?php if ($profesional->getFeaturedOrder() > 0): ?>
                    <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $profesional->getFeaturedOrder() ?></li>
                <?php endif; ?>
            <?php endif; ?>
            <br/>
            <li>
                <strong>Recomendación:</strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($profesionalRecomenda->getDescription()); ?>
                <div style="clear:both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', url_for('profesionalLista/showRecomendation?id=' . $profesionalRecomenda->getId()), array("popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200, menubar=1"))); ?>
                </span>
            </li>
            <div style="clear:both; height: 20px;"></div>
            <?php if ($profesional->getFechaNulo()): ?>
                <li>Fecha anulado: <?php echo format_datetime($profesional->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?></li>
            <?php endif; ?>
        </ul>
        <ul class="dragbox-content" style="min-height:0px;">
            <li style="width: 98%;"><h3>Cartas de recomendación</h3></li>
        </ul>
        <h4 style="float: left; width:97%; margin: 3px 0 15px 26px">
            <?php echo format_number_choice('[0]No hay cartas de recomendación|[1]Hay 1 carta de recomendación|[2,+Inf] Hay %n% cartas de recomendación', array('%n%' => count($rLetter)), count($rLetter)); ?>
        </h4>
        <h4 style="float: left; width:97%; margin: 3px 0 15px 26px">
            <?php echo 'Recomendaciones: ' . round($chartData[0]['reco']) . '%'; ?>
        </h4>
        <ul class="alerta_cuestionario">
            <?php $c = 1; ?>
            <?php foreach ($rLetter as $record) : ?>
                <?php include_partial('profesionalLista/letters', array('record' => $record, 'c' => $c)); ?>
                <?php $c++; ?>
            <?php endforeach; ?>
        </ul>
        <?php if ($rLetter->haveToPaginate()): ?>
            <div class="pagination">
                <span class="result"><?php echo $rLetter->getNbResults() . ' resultados'; ?></span>
                <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'profesionalLista/show?page=' . $rLetter->getFirstPage() . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
                <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'profesionalLista/show?page=' . $rLetter->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
                <?php foreach ($rLetter->getLinks() as $page): ?>
                    <?php echo ($page == $rLetter->getPage()) ? $page : link_to($page, 'profesionalLista/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
                    <?php if ($page != $rLetter->getCurrentMaxLink()): ?>
                        -
                    <?php endif ?>
                <?php endforeach ?>
                <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'profesionalLista/show?page=' . $rLetter->getNextPage() . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
                <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'profesionalLista/show?page=' . $rLetter->getLastPage() . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
            </div>
        <?php endif; ?>
        <div class="clean_clear_0_negra"></div>
        <ul class="dragbox-content" style="min-height:0px;">
            <li style="width: 98%;"><h3>Cartas de desaprobación</h3></li>
        </ul>
        <h4 style="float: left; width:97%; margin: 3px 0 15px 26px">
            <?php echo format_number_choice('[0]No hay cartas de desaprobación|[1]Hay 1 cartas de desaprobación|[2,+Inf] Hay %n% cartas de desaprobación', array('%n%' => count($dLetter)), count($dLetter)); ?>
        </h4>
        <h4 style="float: left; width:97%; margin: 3px 0 15px 26px">
            <?php echo 'Desaprobaciones: ' . round($chartData[0]['disp']) . '%'; ?>
        </h4>
        <ul class="alerta_cuestionario">
            <?php $c = 1; ?>
            <?php foreach ($dLetter as $record) : ?>
                <?php include_partial('profesionalLista/letters', array('record' => $record, 'c' => $c)); ?>
                <?php $c++; ?>
            <?php endforeach; ?>
        </ul>
        <?php if ($dLetter->haveToPaginate()): ?>
            <div class="pagination">
                <span class="result"><?php echo $dLetter->getNbResults() . ' resultados'; ?></span>
                <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'profesionalLista/show?pg=' . $dLetter->getFirstPage() . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $profesional->id) ?>
                <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'profesionalLista/show?pg=' . $dLetter->getPreviousPage() . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $profesional->id) ?>
                <?php foreach ($dLetter->getLinks() as $page): ?>
                    <?php echo ($page == $dLetter->getPage()) ? $page : link_to($page, 'profesionalLista/show?pg=' . $page . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $profesional->id) ?>
                    <?php if ($page != $dLetter->getCurrentMaxLink()): ?>
                        -
                    <?php endif ?>
                <?php endforeach ?>
                <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'profesionalLista/show?pg=' . $dLetter->getNextPage() . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $profesional->id) ?>
                <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'profesionalLista/show?pg=' . $dLetter->getLastPage() . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $profesional->id) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="clean_clear_0_negra"></div>
    <div>
        <?php echo $activeReasonForm->renderFormTag(url_for('profesionalLista/show?form=submit'), array('method' => 'POST', 'id' => 'profesional_reason')) ?>
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
                <td><?php echo $activeReasonForm['active_reason']->renderLabel(); //echo __('Indicadores de excelencia').' :'                                 ?>
                    <input type="hidden" value="<?php echo $sf_params->get('id') ?>" name="id">
                    <input type="hidden" name="siguiente" value="0" id="Siguiente">
                </td>
                <td><br>
                    <?php echo $activeReasonForm['active_reason']->render(array('onkeyup' => 'counttextarea(this.id, "Error_max_length_incidencia")')) ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $activeReasonForm['profesionalGoogleMap']->renderLabel(); ?></td>
                <td>
                    <div class="content">
                        <?php echo $activeReasonForm['profesionalGoogleMap']->render(); ?>
                    </div>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <ul class='sf_admin_actions' style="margin: 10px 10px 10px 0px !important;">
        <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@profesional_lista', array('class' => 'sf_admin_action_cancel')) ?></li>
        <!--li class='sf_admin_action_list'><?php //echo link_to('Volver a profesional en lista', '@profesional_profesionalesListaBlanca', array('class' => 'sf_admin_action_cancel'))                                 ?></li-->
        <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'profesional_lista_edit', array('id' => $profesional->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var msg = $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list li").html();
        $("div.content div.error").html("Para publicar un profesional necesitas asociarle una ubicación.");
        $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list").hide();

        $('.featured').bind('click', function(){
            if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
                alert('<?php echo __('No puedes destacar más de 11 profesionales del Directorio en la Home.') ?>');
                return false;
            }
        });
    });
</script>
<style type="text/css">
    ul.alerta_cuestionario li{
        background: none !important;
        list-style-type: none;
        padding-left: 5px;
    }
    .empresa_ul_audit{
        float: left;
        margin: 0 0 0 25px;
        min-height: 50px;
    }
    .empresa_audit{
        background: none !important;
        float: left;
        width: 99%;
        margin: 0 0 0 12px;
    }
    .empresa_date{
        float: left;
        width: 135px;
    }
    .empresa_user_name{
        float: left;
        width: 200px;
        padding-right: 35px;
    }
    .empresa_title{
        float: left;
        width: 367px;
        padding-right: 50px;
    }
    .empresa_pun_total{
        float: left;
        width: 150px;
    }
    .empresa_ver_comment{
        float: left;
        width: 150px;
    }
    .empresa_comentario{
        float: left;
        width: 125px;
    }
    .empresa_comment_aprobar{
        float: left;
        width: 200px;
    }
    .empresa_aprobar{
        float: left;
        width: 83px;
    }
    .pagination{
        float: left;
        width: 98%;
        margin: 5px 0 10px 30px;
    }
    .pagination .result{
        color: #006400;
        float: left;
        width: 85px;
        margin: -2px 0 0 0;
    }
    .empresa_number{
        float: left;
        margin-top: -1px;
        width: 30px;
    }
    .empresa_kpi{
        padding-left: 25px !important;
    }
    #sf_admin_container ul.sf_admin_actions {
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    .ver_link{
        float: left;
        /*float: left; width: 100%; */
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        /* float: left;*/
        width: 100%;
    }
    .ui-dialog #dialog ul li{ list-style: disc; }
</style>