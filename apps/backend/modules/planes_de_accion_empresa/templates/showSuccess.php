<!--<div id="sf_admin_container">
<h1>Detalle del Plan de acción de Empresa/Entidad</h1>


<div id="sf_admin_content">
<table>
        <thead><tr><th>Plan de acción</th></tr></thead>
<tbody>
<tr>
        <td><?php //echo html_entity_decode($contribucion->getPlanAccion())                                 ?></td>
</tr>
</tbody>
</table>  
</div>
<?php //echo link_to('Volver al Listado','planes_de_accion_empresa/index')?>
</div>-->

<?php use_helper('I18N', 'Date', 'Text') ?>
<?php include_partial('contribucion/assets') ?>
<div id="sf_admin_container">

    <h1>Detalle de la contribución</h1>


    <div id="sf_admin_content">
        <?php //include_partial('contribucion/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('contribucion/list_header') ?>
        </div>



        <div id="concurso_actions" style="float:right">
            <?php include_partial("contribucion/actions", array("contribucion" => $contribucion, "helper" => $helper, 'n_contribuciones_destacados' => $n_contribuciones_destacados)) ?>
        </div>

        <h2><?php echo __($contribucion->name, array(), 'messages') ?></h2>
        <ul class="dragbox-content">
            <li><strong>Fecha:</strong> <?php echo format_datetime($contribucion->getCreatedAt(), "HH:mm d/M/y", "es_ES") ?></li>
            <li><strong>Estado:</strong> 
                <?php
                if ($contribucion->getConcurso()->getConcursoEstadoId() == 4)
                    echo 'Deliberación';
                else
                    echo $contribucion->ContribucionEstado->name
                    ?>
            </li>
            <li><strong>Usuario:</strong> <?php echo $contribucion->User->username ?></li>
            <li><strong>Tipo de concurso:</strong> <?php echo $contribucion->getTipoConcurso() ?></li>
            <li><strong>Destacada:</strong> <?php
            if ($contribucion->getDestacado() == 1) {
                echo "Si";
            } else {
                echo "No";
            }
                ?></li>
            <li><strong>Concurso:</strong> <?php echo link_to($contribucion->Concurso->name, "concurso/show?id=" . $contribucion->Concurso->id) ?></li>
            <?php if ($contribucion->getConcurso()->getConcursoTipoId() == 2): ?>
                <li><strong>Producto: </strong><?php echo $contribucion->getConcursoProducto(); ?> </li>
                <li><strong>Marca: </strong><?php echo $contribucion->getConcursoProductoMarca(); ?> </li>
                <?php if ($contribucion->getConcursoProductoModelo()): ?>
                    <li><strong>Modelo: </strong><?php echo $contribucion->getConcursoProductoModelo(); ?> </li>
                <?php endif ?>
                <li><strong>Sector del producto: </strong><?php echo $contribucion->getConcurso()->getProducto()->getSectorProduct(); ?> </li>
                <li><strong>Subsector de producto: </strong><?php echo $contribucion->getConcurso()->getProducto()->getSubSectorProduct(); ?> </li>
                <?php if ($contribucion->getConcurso()->getProducto()->getProductoTipoTres()->getId()): ?>
                    <li><strong>Tipo de producto: </strong><?php echo $contribucion->getConcurso()->getProducto()->getProductTresName(); ?> </li>
                <?php endif; ?>
            <?php endif ?>
            <?php if ($contribucion->getConcurso()->getConcursoTipoId() == 1): ?>
                <li><strong>Empresa/Entidad: </strong><?php echo $contribucion->getConcurso()->getEmpresa(); ?> </li>
                <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getEmpresaRoadType()->getId()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getEmpresaRoadType()->getId())): ?>
                    <li><strong>Tipo de vía: </strong><?php echo $contribucion->getEmpresaRoadType(); ?> </li>
                <?php endif; ?>
                <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getConcurso()->getEmpresa()->getDireccion()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getConcurso()->getEmpresa()->getDireccion())): ?>
                    <li><strong>Dirección: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getDireccion(); ?> </li>
                <?php endif; ?>
                <?php if (($contribucion->getEmpresaState() != "Toda España" && $contribucion->getConcurso()->getEmpresa()->getNumero()) || ($contribucion->getEmpresaState() == "Toda España" && $contribucion->getConcurso()->getEmpresa()->getNumero())): ?>
                    <li><strong>Nº: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getNumero(); ?> </li>
                <?php endif; ?>
                <?php if ($contribucion->getConcurso()->getEmpresa()->getPiso()): ?>
                    <li><strong>Piso: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getPiso(); ?> </li>
                <?php endif ?>
                <?php if ($contribucion->getConcurso()->getEmpresa()->getPuerta()): ?>
                    <li><strong>Puerta: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getPuerta(); ?> </li>
                <?php endif ?>
                <li><strong>Sector: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getSector(); ?> </li>
                <li><strong>Subsector: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getSubSector(); ?> </li>
                <?php if ($contribucion->getConcurso()->getEmpresa()->getEmpresaSectorTres()->getId()): ?>
                    <li><strong>Actividad: </strong><?php echo $contribucion->getConcurso()->getEmpresa()->getTresSectorNew(); ?> </li>
                <?php endif; ?>
                <li><strong>Provincia: </strong><?php echo $contribucion->getEmpresaState(); ?> </li>
                <li><strong>Localidad: </strong><?php echo $contribucion->getEmpresaCity(); ?> </li>
            <?php endif ?>
            <?php if ($contribucion->principal): ?>
                <li><strong>Esta es la contribución inicial del concurso: <?php echo $contribucion->Concurso->name ?></strong></li>
            <?php endif; ?>
            <br>
            <li><strong>Descripción de la incidencia:</strong>
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->incidencia) ?>
                <span class="ver_link">
                    <div style="clear: both; height: 16px;"></div>
                    <?php echo link_to('ver +', 'planes_de_accion/showIncidenciaDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>   
                </span>
                <?php //echo link_to('descargar pdf', 'contribucion/Download_pdfIncidencia?id=' . $contribucion->getId())   ?>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Resumen del Plan de acción:</strong> 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->resumen) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">               
                    <?php echo link_to('ver +', 'planes_de_accion/showResumen?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Plan de acción:</strong>
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->plan_accion) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">              
                    <?php echo link_to('ver +', 'planes_de_accion/showPlanAccionDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
                <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion->getId()) ?>   
            </li>
            <?php if (count($contribucion->getArchivos()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Archivos</strong>:
                    <ul>
                        <?php
                        $c = 1;
                        foreach ($contribucion->getArchivos() as $a) {
                            $t = explode(".", $a->getFile());
                            echo '<li><a href="/images/uploads/documents/' . $a->getFile() . '">Archivo' . $c . '.' . end($t) . '</a></li>';
                            $c++;
                        }
                        ?></ul>
                <?php endif; ?>
            </li>    
            <?php if ($contribucion->getVotosTotales() > 0 || $contribucion->getPuntosTotales() > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><?php if ($contribucion->getVotosTotales() > 0): ?><span class="bold">Votos recibidos</span>: <?php echo $contribucion->getVotosTotales() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
                    <?php if ($contribucion->getPuntosTotales() > 0): ?><span class="bold">Puntos conseguidos</span>: <?php echo $contribucion->getPuntosTotales() ?><?php endif; ?>
                    <?php if ($contribucion->getVotosTotales()): ?>  
                        <ul>	
                            <?php foreach ($contribucion->ConcursoReferendum as $i => $voto): ?>
                                <li><?php echo format_number_choice('[0]El usuario %user% ha dado 0 puntos|[1]El usuario %user% ha dado 1 punto|(1,+Inf]El usuario %user% ha dado %count% puntos', array('%user%' => $voto->sfGuardUser->username, '%count%' => $voto->value), $voto->value) ?><br /><br /></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        </ul> 
    </div>
    <div style="clear:both; height: 11px;"></div>
    <ul class='sf_admin_actions' style="margin-left: 6px !important;">
        <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@contribucion_planes_de_accion_empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
    </ul>
    <div id="sf_admin_footer">
        <?php //include_partial('contribucion/list_footer') ?>
    </div>
</div>
<style type="text/css">
    .ver_link{
        float:left;
        margin: 0px 0px 5px -19px;
    }
    #sf_admin_container h2 {
        min-height: 17px;   
    }
</style>


