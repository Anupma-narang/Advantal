<?php use_helper('I18N', 'Date', 'Text') ?>
<?php //include_partial('contribucion/assets')                         ?>
<div id="sf_admin_container">

    <h1>Detalle de la contribución de Producto</h1>


    <div id="sf_admin_content">
        <?php include_partial('contribucion/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('contribucion/list_header') ?>
        </div>



        <div id="concurso_actions" style="float:right">
            <?php include_partial("contribucion/actions", array("contribucion" => $contribucion, "helper" => $helper, 'n_contribuciones_destacados' => $n_contribuciones_destacados)) ?>
        </div>

        <h2><?php echo __($contribucion->name, array(), 'messages') ?></h2>
        <ul class="dragbox-content">
            <li><strong>Fecha:</strong> <?php echo format_datetime($contribucion->getCreatedAt(), "d/M/y", "es_ES") ?></li>
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
            <li><strong>Concurso asociado:</strong> <?php echo link_to($contribucion->Concurso->name, "concurso/show?id=" . $contribucion->Concurso->id) ?></li>
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
            <?php if ($contribucion->principal): ?>
                <li><strong>Esta es la contribución inicial del concurso: <?php echo $contribucion->Concurso->name ?></strong></li>
            <?php endif; ?>
            <br>
            <li><strong>Descripción de la incidencia:</strong> 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->incidencia) ?>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'contribucion/showIncidenciaDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>			
                </span>
                <?php //echo link_to('descargar pdf', 'contribucion_product/Download_pdfIncidencia?id=' . $contribucion->getId())  ?>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Resumen del Plan de acción:</strong>
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->resumen) ?>
                <span class="ver_link">               
                    <?php echo '<br/>' . link_to('ver +', 'contribucion_product/showResumen?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Plan de acción:</strong> 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->plan_accion) ?>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'contribucion/showPlanAccionDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
                <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion->getId()) ?>			
            </li>
            <!--<br>-->
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

        <?php if ($contribucion->getContribucionEstadoId() == 1): ?>		
            <?php if ($contribucion->getArchivos() || (!$contribucion->getVotosTotales() > 0 && !$contribucion->getPuntosTotales() > 0)): ?>
                <div style="clear: both; height: 50px;"></div>
            <?php else: ?>
                <div style="clear: both; height: 22px;"></div>
            <?php endif; ?>
            <div id="Asignacion_puntos_content" style="margin-left: 8px;">
                <h2>Asignación de puntos</h2>
                <div id="Asignacion_puntos_inner">
                    <form id="Puntos_form" action="<?php echo url_for('contribucion/changeStatus?id=' . $contribucion->getId()) ?>" method="get">
                        <input type="hidden" name="estado" value="2">
                        <input type="hidden" name="siguiente" value="0" id="Siguiente">
                        <table>
                            <tbody>
                                <?php $c = 1 ?>			
                                <tr>
                                    <td></td>
                                    <td ><strong><?php echo __('Tipo de puntos') ?></strong></td>
                                    <td ><select name="point_type">
                                            <option value="1" selected="selected"><?php echo __('Ambos'); ?></option>
                                            <option value="2"><?php echo __('Puntos acumulados'); ?></option>
                                            <option value="3"><?php echo __('Puntos canjeables'); ?></option>
                                        </select></td>
                                </tr>
                                <?php foreach ($puntos as $p): ?>
                                    <tr>
                                        <td><input type="checkbox" name="<?php echo $p->getCodigo() ?>"
                                                   value="true"></td>
                                        <td><?php echo $p->getDescripcion() ?></td>
                                        <td style="text-align: right;"<strong><?php echo number_format($p->puntos, 0, '.', '.'); ?></strong></td>
                                    </tr>			
                                    <?php $c++ ?>			
                                <?php endforeach; ?>
                                <tr>
                                    <th>Otro</th>
                                    <td><input type="text" name="otro_descripcion" size="40" id="Otro_descripcion"></td>
                                    <td style="text-align: right;"><input type="text" name="otro_puntos" size="10" id="Otro_puntos"></td>
                                </tr>			
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div style="clear: both; height: 3px;"></div>  
        <?php endif; ?>
        <ul class='sf_admin_actions' style="margin-left: 6px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@contribucion_contribucion_empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="sf_admin_footer">
        <?php include_partial('contribucion/list_footer') ?>
    </div>
</div>
<style type="text/css">
    .ver_link{
        float:left;
        margin: 0px 0px 5px -19px;
    }
    #Asignacion_puntos_content {
        max-width: 548px;
    }
</style>