<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1>Detalle del concurso pendiente de Empresa/Entidad</h1>

    <div id="sf_admin_content">
        <?php include_partial('concursos_pendientes_empresa/flashes') ?>
        <div id="sf_admin_header">
            <?php include_partial('concursos_pendientes_empresa/list_header') ?>
        </div>
        <div id="concurso_actions" style="float: right">
            <?php
            include_partial("concursos_pendientes/actions", array(
                "concurso" => $concurso,
                "helper" => $helper,
                'n_concursos_destacados' => $n_concursos_destacados,
                'n_concursos_destacados_tiempo' => $n_concursos_destacados_tiempo
            ))
            ?>
        </div>

        <h2>
            <?php echo __($concurso->name, array(), 'messages') ?>
        </h2>
        <ul class="dragbox-content">
            <li><span class="bold">Fecha</span>: <?php echo format_datetime($concurso->getCreatedAt(), "HH:mm dd/MM/y", "es_ES") ?>
            </li>
            <?php if ($concurso->getFechaRevision()): ?>
                <li><span class="bold">Fecha de revisión</span>: <?php echo format_datetime($concurso->fecha_revision, "HH:mm dd/MM/y", "es_ES") ?>
                <?php endif; ?>
                <?php if ($concurso->getFechaActivacion()): ?>
                <li><span class="bold">Fecha de activación</span>: <?php echo format_datetime($concurso->fecha_activacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaReferendum()): ?>
                <li><span class="bold">Fecha de Referéndum</span>: <?php echo format_datetime($concurso->fecha_referendum, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaDeliberacion()): ?>
                <li><span class="bold">Fecha de Deliberación</span>: <?php echo format_datetime($concurso->fecha_deliberacion, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaCerrado()): ?>
                <li><span class="bold">Fecha cerrado</span>: <?php echo format_datetime($concurso->fecha_cerrado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaRechazado()): ?>
                <li><span class="bold">Fecha rechazado</span>: <?php echo format_datetime($concurso->fecha_rechazado, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaNulo()): ?>
                <li><span class="bold">Fecha anulado</span>: <?php echo format_datetime($concurso->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <li><span class="bold">Estado</span>: <?php echo $concurso->ConcursoEstado->name ?>
            </li>
            <li><span class="bold">Usuario</span>: <?php echo $concurso->User ?>
            </li>
            <li><span class="bold">Tipo de concurso</span>: <?php echo $concurso->ConcursoTipo->name ?>
            </li>
            <li><span class="bold">Categoría</span>: <?php echo $concurso->ConcursoCategoria->name ?>
            </li>
            <?php if ($concurso->ConcursoTipo->id == 1): ?>
                <li><span class="bold">Empresa/Entidad</span>: <?php echo $concurso->Empresa->name ?>
                </li>
                <?php if (($concurso->States->name != "Toda España" && $concurso->getEmpresa()->getRoadTypeId()) || ($concurso->States->name == "Toda España" && $concurso->getEmpresa()->getRoadTypeId())): ?>
                    <li><span class="bold">Tipo de vía</span>: <?php echo $concurso->Empresa->RoadType->name ?>
                    </li>
                <?php endif; ?>
                <?php if (($concurso->States->name != "Toda España" && $concurso->concurso_address) || ($concurso->States->name == "Toda España" && $concurso->concurso_address)): ?>
                    <li><span class="bold">Dirección</span>: <?php echo $concurso->concurso_address ?><?php echo $concurso->concurso_numero ? ', Nº: ' . $concurso->concurso_numero : '' ?><?php echo $concurso->concurso_piso ? ', Piso: ' . $concurso->concurso_piso : '' ?><?php echo $concurso->concurso_puerta ? ', Puerta: ' . $concurso->concurso_puerta : '' ?>
                    </li>
                <?php endif; ?>
                <li><span class="bold">Provincia</span>: <?php echo $concurso->States->name ?>
                </li>
                <li><span class="bold">Localidad</span>: <?php echo $concurso->getCity()->getName() ?>
                </li>
                <?php if ($concurso->getEmpresa()->getCodigopostal()): ?>
                    <li><span class="bold">C.P.</span>: <?php echo $concurso->getEmpresa()->getCodigopostal() ?></li>
                <?php endif; ?>
                <li><span class="bold">Sector</span>: <?php echo $concurso->getEmpresa()->getSector(); ?>
                <li><span class="bold">Subsector</span>: <?php echo $concurso->getEmpresa()->getSubSector(); ?>
                </li>
                <?php if ($concurso->getEmpresa()->getEmpresaSectorTresId()): ?>
                    <li><span class="bold">Actividad</span>:
                        <?php echo $concurso->getEmpresa()->getEmpresaSectorTres(); ?>
                    </li>
                <?php endif; ?>
            <?php elseif ($concurso->ConcursoTipo->id == 2): ?>
                <li><span class="bold">Producto</span>: <?php echo $concurso->Producto->name ?>
                </li>
                <li><span class="bold">Marca</span>: <?php echo $concurso->getProducto()->getMarca() ?>
                </li>
                <li><span class="bold">Modelo</span>: <?php echo $concurso->getProducto()->getModelo() ?>
                </li>
                <?php if ($concurso->getProducto()->getProductoTipoTresId()): ?>
                    <li><strong>Tipo de producto:</strong> <?php echo $concurso->getProducto()->getProductoTipoTres()->getName() ?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <br>
            <li><span class="bold">Descripción de la incidencia</span>:
                <p class="mr-span"> </p><?php echo html_entity_decode($concurso->incidencia) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'concursos_pendientes/showIncidencia?id=' . $concurso->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                    <?php //echo link_to('descargar pdf', 'concursos_pendientes/Download_pdfIncidencia?id='.$concurso->getId())?>
                </span>
            </li>
            <?php $contribucion_principal = $concurso->getContribucionPrincipal(); ?>
            <div style="clear: both; height: 22px;"></div>
            <li><span class="bold">Resumen del Plan de acción</span>: <p class="mr-span"> </p>
                <?php echo $contribucion_principal ? html_entity_decode($contribucion_principal->getResumen()) : '' ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php if ($contribucion_principal): ?>
                        <?php echo link_to('ver +', 'concursos_pendientes/showResumenPlanAccion?id=' . $contribucion_principal->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                    <?php endif; ?>
                </span>
            </li>
            <?php if ($contribucion_principal): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><span class="bold">Plan de acción</span>: <p class="mr-span"> </p>
                    <?php echo html_entity_decode($contribucion_principal->plan_accion) ?>
                    <div style="clear: both; height: 16px;"></div>
                    <span class="ver_link">
                        <?php echo link_to('ver +', 'concursos_pendientes/showPlanAccion?id=' . $contribucion_principal->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                        <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion_principal->getId()) ?>
                    </span>
                </li>
            <?php endif ?>
            <?php if (count($concurso->getArchivos()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><span class="bold">Archivos:</span>
                    <ul>
                        <?php
                        $c = 1;
                        foreach ($concurso->getArchivos() as $a) {
                            $t = explode(".", $a->getFile());
                            echo '<li><a href="/images/uploads/documents/' . $a->getFile() . '">Archivo' . $c . '.' . end($t) . '</a></li>';
                            $c++;
                        }
                        ?></ul>
                </li><div style="clear: both; height: 2px;"></div>
            <?php else: ?>
                <div style="clear: both; height: 10px;"></div>
            <?php endif; ?>
        </ul>
        <?php if ($concurso->getConcursoEstadoId() == 1): ?>
            <div style="clear: both; height: 35px;"></div>
            <div id="Asignacion_puntos_content" style="margin-left: 8px;">
                <h2>Asignación de puntos</h2>
                <div id="Asignacion_puntos_inner">
                    <form id="Puntos_form" action="<?php echo url_for('concursos_pendientes/changeStatus?id=' . $concurso->getId()) ?>" method="get">
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

        <?php if ($concurso->concurso_estado_id == 4): // Deliberación ?>
            <?php $results = $concurso->getReferendumResult() ?>
            <?php if (count($results)): ?>
                <br/>
                <h3>Resultado del concurso</h3>
                <table class="results">
                    <thead><tr><th>Puesto</th><th>Colaborador</th><th>Contribución</th><th>Puntos</th><th>Colaboradores que le han votado</th></tr></thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($results as $r) {
                            printf('<tr><td class="num">%s</td><td>%s</td><td>%s</td><td class="num">%s</td><td class="num">%s</td></tr>', $count, $r['username'], link_to($r['contribucion_name'], "contribucion/show?id=" . $r['contribucion_id']), $r['puntos'], $r['votos']);
                            $count = $count + 1;
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>



        <?php if (count($comentarios) > 0): ?>
            <h2>Comentarios</h2>
            <table><tbody>
                    <?php foreach ($comentarios as $comentario): ?>
                        <tr>
                            <th><?php echo $comentario->getUser()->getUsername() ?></th>
                            <td><?php echo $comentario->getMensaje() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody></table>
        <?php endif; ?>

        <?php if ($concurso->getConcursoEstadoId() != 1): ?>
            <div style="clear: both; height: 35px;"></div>
            <div class="contribuciones" style="clear: both">
                <h2>Contribuciones</h2>
                <?php if (count($concurso->Contribuciones)): ?>
                    <?php foreach ($concurso->Contribuciones as $contribucion): ?>
                        <div class="concurso_contribucion">
                            <?php if ($contribucion->getDestacado()): ?>
                                <p><?php echo image_tag('/images/info-icon.png') ?><strong>¡Esta es una contribución destacada!</strong></p>
                            <?php endif; ?>
                            <ul>
                                <li><span class="bold">Fecha</span>: <?php echo format_datetime($contribucion->getCreatedAt(), "HH:mm d/M/y", "es_ES") ?></li>
                                <li><span class="bold">Título</span>: <?php echo $contribucion->name ?></li>
                                <li><?php echo $contribucion->ContribucionEstado->name ?></li>
                                <li><span class="bold">Usuario</span>: <?php echo $contribucion->User->username ?></li>
                                <?php /*
                                  <br/>
                                  <li><span class="bold">Incidencia</span>:
                                  <p class="mr-span"> </p>
                                  <?php echo html_entity_decode($contribucion->incidencia) ?>
                                  <span class="ver_link">
                                  <?php echo '<br/>' . link_to('ver +', 'contribucion/showIncidencia?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                                  </span>
                                  </li>
                                  <div style="clear: both; height: 22px;"></div>
                                  <li><span class="bold">Resumen Plan de acción</span>:
                                  <p class="mr-span"> </p>
                                  <?php echo html_entity_decode($contribucion->resumen) ?>
                                  </li>
                                  <div style="clear: both; height: 17px;"></div>
                                  <li><span class="bold">Plan de acción</span>:
                                  <p class="mr-span"> </p>
                                  <?php echo html_entity_decode($contribucion->plan_accion) ?>
                                  <span class="ver_link">
                                  <?php echo '<br/>' . link_to('ver +', 'contribucion/showPlanAccion?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                                  <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion->getId()) ?>
                                  </span>
                                  </li>

                                 */ ?>
                                <?php if (count($contribucion->getArchivos()) > 0): ?>
                                    <div style="clear: both; height: 22px;"></div>
                                    <li><span class="bold">Archivos</span>:
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
                                <?php else: ?>
                                    <div style="clear: both; height: 2px;"></div>
                                <?php endif; ?>

                            </ul>
                            <ul style="margin-left: 6px;">
                                <li><p>
                                        <?php echo link_to("Ver contribución", "contribucion/show?id=" . $contribucion->id) ?>
                                        <?php if ($contribucion->destacado): ?>
                                            <?php echo link_to("Quitar destacado", "contribucion/retirar?contribucion_id=" . $contribucion->id) ?>
                                        <?php elseif ($contribucion->contribucion_estado_id == 2 && in_array($concurso->getConcursoEstadoId(), array(2, 3))): ?>
                                            <?php echo link_to("Destacar", "contribucion/destacar?contribucion_id=" . $contribucion->id) ?>
                                        <?php endif; ?>
                                    </p></li>
                            </ul>
                        </div>
                        <hr/>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Este concurso no tiene contribuciones</p>
                <?php endif; ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div id="sf_admin_footer">
            <?php include_partial('concursos_pendientes/list_footer') ?>
        </div>
    </div>
<?php endif; ?>
<style type="text/css">
    #Asignacion_puntos_content {
        max-width: 548px;
    }
    .ver_link{ float:left;margin: 0px 0px 5px -19px; }
</style>