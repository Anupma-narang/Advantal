<?php use_helper('I18N', 'Date', 'Text') ?>
<?php //include_partial('contribuciones_pendientes/assets')                           ?>
<div id="sf_admin_container">

    <h1>Detalle de la contribución pendiente</h1>


    <div id="sf_admin_content">
        <?php include_partial('contribuciones_pendientes/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('contribuciones_pendientes/list_header') ?>
        </div>



        <div id="concurso_actions" style="float:right">
            <?php include_partial("contribuciones_pendientes/actions", array("contribucion" => $contribucion, "helper" => $helper, 'n_contribuciones_destacados' => $n_contribuciones_destacados)) ?>
        </div>

        <h2><?php echo __($contribucion->name, array(), 'messages') ?></h2>
        <ul class="dragbox-content">
            <li><span class="bold">Fecha</span>: <?php echo format_datetime($contribucion->getCreatedAt(), "HH:mm d/M/y", "es_ES") ?></li>
            <li><span class="bold">Estado</span>: 
                <?php
                if ($contribucion->getConcurso()->getConcursoEstadoId() == 4)
                    echo 'Deliberación';
                else
                    echo $contribucion->ContribucionEstado->name
                    ?>
            </li>
            <li><span class="bold">Usuario</span>: <?php echo $contribucion->User->username ?></li>
            <li><span class="bold">Tipo de concurso</span>: <?php
            if ($contribucion->getConcurso()->getConcursoTipoId() == 1) {
                echo "Empresa/Entidad";
            } else {
                echo "Producto";
            }
                ?></li>
            <li><span class="bold">Concurso asociado:</span> <?php echo link_to($contribucion->Concurso->name, "concurso/show?id=" . $contribucion->Concurso->id) ?></li>
            <?php if ($contribucion->principal): ?>
                <li><strong>Esta es la contribución inicial del concurso</span>: <?php echo $contribucion->Concurso->name ?></strong></li>
            <?php endif; ?>
            <br>
            <li style="float: left; width: 990px;">
                <span class="bold">Descripción de la incidencia</span>: 
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->incidencia) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'contribuciones_pendientes/showIncidencia?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>			
                </span>
                <?php //echo link_to('descargar pdf', 'contribuciones_pendientes/download_pdf?id=' . $contribucion->getId())  ?>
            </li>
            <div style="clear: both; height: 12px;"></div>
            <li><span class="bold">Resumen del Plan de acción</span>:
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->resumen) ?>
                <span class="ver_link">           
                    <?php echo '<br/>' . link_to('ver +', 'contribuciones_pendientes/showResumenPlanAccion?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>    
                </span>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><span class="bold">Plan de acción</span>: 
                <p class="mr-span"> </p> 
                <?php echo html_entity_decode($contribucion->plan_accion) ?>
                <span class="ver_link">               
                    <?php echo '<br/>' . link_to('ver +', 'contribuciones_pendientes/showPlanAccion?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
                <?php //echo link_to('descargar pdf', 'contribuciones_pendientes/download_pdf?id=' . $contribucion->getId())  ?>			
            </li>
            <?php if (count($contribucion->getArchivos()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><span class="bold">Archivos:</span>
                    <ul>
                        <?php
                        $c = 1;
                        foreach ($contribucion->getArchivos() as $a) {
                            $t = explode(".", $a->getFile());
                            echo '<li><a href="/images/uploads/documents/' . $a->getFile() . '">Archivo' . $c . '.' . end($t) . '</a></li>';
                            $c++;
                        }
                        ?>
                    </ul>
                </li>	 
                <div style="clear:both; height: 3px;"></div>
            <?php else: ?>  
                <div style="clear:both; height: 11px;"></div>
            <?php endif; ?>
        </ul>

        <?php if ($contribucion->getContribucionEstadoId() == 1): ?>
            <?php if ($contribucion->getArchivos() || (!$contribucion->getVotosTotales() > 0 && !$contribucion->getPuntosTotales() > 0)): ?>
                <div style="clear: both; height: 42px;"></div>
            <?php else: ?>
                <div style="clear: both; height: 22px;"></div>
            <?php endif; ?>
            <div id="Asignacion_puntos_content" style="margin-left: 8px;">
                <h2>Asignación de puntos</h2>
                <div id="Asignacion_puntos_inner">
                    <form id="Puntos_form" action="<?php echo url_for('contribuciones_pendientes/changeStatus?id=' . $contribucion->getId()) ?>" method="get">
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
                                        <td style="text-align: right;"><strong><?php echo number_format($p->puntos, 0, '.', '.'); ?></strong></td>
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
        <?php endif; ?>  
        <ul class='sf_admin_actions' style="margin-left: 6px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@contribuciones_pendientes', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="sf_admin_footer">
        <?php include_partial('contribuciones_pendientes/list_footer') ?>
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
    #sf_admin_container h2 {
        min-height: 17px;
    }
</style>