<?php use_helper('Text') ?>
<?php use_javascript('fancybox/jquery.fancybox.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="sf_admin_container">
    <h1>Detalle del concurso de Producto</h1>
    <?php include_partial('flashes') ?>
    <div id="sf_admin_content">

        <div id="sf_admin_header">
            <?php include_partial('concurso/list_header') ?>
        </div>


        <div id="concurso_actions" style="float: right">
            <?php
            include_partial("concurso/actions", array(
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
            <li><strong>Fecha:</strong> <?php echo format_datetime($concurso->getCreatedAt(), "dd/MM/y", "es_ES") ?>
            </li>
            <?php if ($concurso->getFechaActivacion()): ?>

                <li>Fecha de activación: <?php echo format_datetime($concurso->fecha_activacion, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaReferendum()): ?>
                <li>Fecha de Referéndum: <?php echo format_datetime($concurso->fecha_referendum, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaDeliberacion()): ?>
                <li>Fecha de Deliberación: <?php echo format_datetime($concurso->fecha_deliberacion, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaObservacion()): ?>
                <li>Fecha de Observación: <?php echo format_datetime($concurso->fecha_observacion, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaCerrado()): ?>
                <li>Fecha cerrado: <?php echo format_datetime($concurso->fecha_cerrado, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if ($concurso->getFechaRechazado()): ?>
                <li>Fecha rechazado: <?php echo format_datetime($concurso->fecha_rechazado, "dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php
            for ($i = 0; $i <= 10; $i++):
                ?>
                <?php if (isset($arr_cambios_estados_revisiones[$i])): ?>
                    <li>Fecha de Revisión: <?php echo format_datetime($arr_cambios_estados_revisiones[$i], "dd/MM/y", "es_ES") ?></li>
                <?php endif ?>
                <?php if (isset($arr_cambios_estados_reactivaciones[$i])): ?>
                    <li>Fecha de reactivación: <?php echo format_datetime($arr_cambios_estados_reactivaciones[$i], "dd/MM/y", "es_ES") ?></li>
                <?php endif ?>
            <?php endfor ?>
            <li><strong>Estado:</strong> <?php echo $concurso->ConcursoEstado->name ?>
            </li>
            <li><strong>Usuario: </strong><?php echo $concurso->User ?>
            </li>
            <li><strong>Tipo de concurso:</strong> <?php echo $concurso->ConcursoTipo->name ?>
            </li>
            <li><strong>Categoría:</strong> <?php echo $concurso->ConcursoCategoria->name ?>
            </li>
            <?php if ($concurso->ConcursoTipo->id == 1): ?>
                <li><strong>Empresa/Entidad:</strong> <?php echo $concurso->Empresa->name ?>
                </li>
                <?php if (($concurso->States->name != "Toda España" && $concurso->getEmpresa()->getRoadTypeId()) || ($concurso->States->name == "Toda España" && $concurso->getEmpresa()->getRoadTypeId())): ?>
                    <li><strong>Tipo de vía:</strong> <?php echo $concurso->Empresa->RoadType->name ?>
                    </li>
                <?php endif; ?>
                <?php if (($concurso->States->name != "Toda España" && $concurso->concurso_address) || ($concurso->States->name == "Toda España" && $concurso->concurso_address)): ?>
                    <li><strong>Dirección:</strong> <?php echo $concurso->concurso_address ?><?php echo $concurso->concurso_numero ? ', Nº:' . $concurso->concurso_numero : '' ?><?php echo $concurso->concurso_piso ? ', Piso:' . $concurso->concurso_piso : '' ?><?php echo $concurso->concurso_puerta ? ', Puerta: ' . $concurso->concurso_puerta : '' ?>
                    </li>
                <?php endif; ?>
                <li><strong>Provincia:</strong> <?php echo $concurso->States->name ?>
                </li>
                <li><strong>Localidad:</strong> <?php echo $concurso->getCity()->getName() ?>
                </li>
                <?php if ($concurso->Empresa->codigopostal): ?>
                    <li><strong>C.P.:</strong> <?php echo $concurso->Empresa->codigopostal ?>
                    </li>
                <?php endif; ?>
                <?php if ($concurso->getEmpresa()->getEmpresaSectorTresId()): ?>
                    <li><strong>Actividad:</strong> <?php echo $concurso->getEmpresa()->getEmpresaSectorTres(); ?>
                    </li>
                <?php endif; ?>
            <?php elseif ($concurso->ConcursoTipo->id == 2): ?>
                <li><strong>Producto:</strong> <?php echo $concurso->Producto->name ?>
                </li>
                <li><strong>Marca:</strong> <?php echo $concurso->getProducto()->getMarca() ?>
                </li>
                <?php if ($concurso->getProducto()->getModelo()): ?>
                    <li><strong>Modelo:</strong> <?php echo $concurso->getProducto()->getModelo() ?>
                    </li>
                <?php endif ?>
                <li><strong>Sector de producto: </strong><?php echo $concurso->getProducto()->getSectorProduct(); ?> </li>
                <li><strong>Subsector del producto: </strong><?php echo $concurso->getProducto()->getSubSectorProduct(); ?> </li>
                <?php if ($concurso->getProducto()->getProductoTipoTresId()): ?>
                    <li><strong>Tipo de producto:</strong> <?php echo $concurso->getProducto()->getProductoTipoTres()->getName() ?>
                    </li>
                <?php endif; ?>
                <?php if ($concurso->getFeatured() > 0): ?>
                    <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                    <?php if ($concurso->getFeaturedOrder() > 0): ?>
                        <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $concurso->getFeaturedOrder() ?></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($concurso->getFechaNulo()): ?>
                <li><strong>Fecha anulado:</strong> <?php echo format_datetime($concurso->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?>
                </li>
            <?php endif; ?>
            <?php if (count($comentarios) > 0): ?>
                <li><strong>Comentarios:</strong> <br />
                    <ul>
                        <?php foreach ($comentarios as $comentario): ?>
                            <li>
                                <strong><?php echo $comentario->getUser()->getUsername() ?>: </strong>
                                <?php echo truncate_text(html_entity_decode($comentario->getMensaje()), 400) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <br>
            <li style="float: left; width: 990px;">
                <strong>Descripción de la incidencia: </strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($concurso->incidencia) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'concurso/showIncidencia?id=' . $concurso->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                    <?php //echo link_to('descargar pdf', 'concurso/Download_pdfIncidencia?id=' . $concurso->getId())    ?>
                </span>
            </li>
            <?php $contribucion_principal = $concurso->getContribucionPrincipal(); ?>
            <div style="clear: both; height: 12px;"></div>
            <li>
                <strong>Resumen del Plan de acción: </strong>
                <p class="mr-span"> </p>
                <?php echo $contribucion_principal ? html_entity_decode($contribucion_principal->getResumen()) : '' ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php if ($contribucion_principal): ?>
                        <?php echo link_to('ver +', 'concurso/showResumenPlanAccion?id=' . $contribucion_principal->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                    <?php endif; ?>
                </span>
            </li>
            <?php if ($contribucion_principal): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Plan de acción:</strong>
                    <p class="mr-span"> </p>
                    <?php echo html_entity_decode($contribucion_principal->plan_accion) ?>
                    <div style="clear: both; height: 16px;"></div>
                    <span class="ver_link">
                        <?php echo link_to('ver +', 'concurso/showPlanAccion?id=' . $contribucion_principal->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                        <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion_principal->getId())    ?>
                    </span>
                </li>
            <?php endif ?>
            <?php if (count($concurso->getArchivos()) > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><strong>Archivos:</strong>
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
                    <form id="Puntos_form" action="<?php echo url_for('concurso/changeStatus?id=' . $concurso->getId()) ?>" method="get">
                        <input type="hidden" name="estado" value="2">
                        <input type="hidden" name="siguiente" value="0" id="Siguiente">
                        <table>
                            <tbody>
                                <?php $c = 1 ?>
                                <tr>
                                    <td></td>
                                    <td><b><?php echo __('Tipo de puntos') ?></b></td>
                                    <td><select name="point_type">
                                            <option value="1" selected="selected"><?php echo __('Ambos'); ?></option>
                                            <option value="2"><?php echo __('Puntos acumulados'); ?></option>
                                            <option value="3"><?php echo __('Puntos canjeables'); ?></option>
                                        </select></td>
                                </tr>
                                <?php foreach ($puntos as $p): ?>
                                    <tr>
                                        <td><input type="checkbox" name="<?php echo $p->getCodigo() ?>" value="true"/></td>
                                        <td><?php echo $p->getDescripcion() ?></td>
                                        <td style="text-align:right;"><strong><?php echo number_format($p->puntos, 0, '.', '.'); ?></strong></td>
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

        <?php if ($concurso->getConcursoEstadoId() != 1): ?>
            <?php if (count($concurso->Contribuciones)): ?>
                <?php foreach ($concurso->Contribuciones as $contribucion): ?>
                    <?php if ($contribucion->principal != 1): ?>  
                        <div style="clear: both; height: 35px;"></div>
                        <div class="contribuciones" style="clear: both">
                            <div id="concurso_actions" style="float:right">
                                <?php include_partial("contribucion/actions", array("contribucion" => $contribucion, "helper" => $helper, 'n_contribuciones_destacados' => $n_contribuciones_destacados)) ?>
                            </div>
                            <h2><?php echo $contribucion->name ?></h2>
                            <div class="concurso_contribucion">
                                <?php if ($contribucion->getDestacado()): ?>
                                    <p><?php echo image_tag('/images/info-icon.png') ?><strong>¡Esta es una contribución destacada!</strong></p>
                                <?php endif; ?>
                                <ul class="dragbox-content">
                                    <li><strong>Fecha</strong>: <?php echo format_datetime($contribucion->getCreatedAt(), "HH:mm d/M/y", "es_ES") ?></li>
                                    <li><strong>Usuario</strong>: <?php echo $contribucion->User->username ?></li>
                                    <!--li><strong>Título</strong>: <?php echo $contribucion->name ?></li-->
                                    <li><strong><?php echo $contribucion->ContribucionEstado->name ?></strong></li>
                                    <br/>
                                    <li>
                                        <strong>Descripción de la incidencia</strong>:
                                        <p class="mr-span"> </p>
                                        <?php echo html_entity_decode($contribucion->incidencia) ?>
                                        <div style="clear: both; height: 16px;"></div>
                                        <span class="ver_link">
                                            <?php echo link_to('ver +', 'contribucion/showIncidenciaDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                                        </span>
                                    </li>
                                    <div style="clear: both; height: 22px;"></div>
                                    <li>
                                        <strong>Resumen Plan de acción</strong>:
                                        <p class="mr-span"> </p>
                                        <?php echo html_entity_decode($contribucion->resumen) ?>
                                        <div style="clear: both; height: 16px;"></div>
                                        <span class="ver_link">
                                            <?php echo link_to('ver +', 'contribucion/showResumen?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                                        </span>
                                    </li>
                                    <div style="clear: both; height: 17px;"></div>
                                    <li><strong>Plan de acción</strong>:
                                        <p class="mr-span"> </p>
                                        <?php echo html_entity_decode($contribucion->plan_accion) ?>
                                        <div style="clear: both; height: 16px;"></div>
                                        <span class="ver_link">
                                            <?php echo link_to('ver +', 'contribucion/showPlanAccionDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                                            <?php //echo link_to('descargar pdf', 'contribucion/download_pdf?id=' . $contribucion->getId())    ?>
                                        </span>
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
                                                ?>
                                            </ul>
                                        </li>
                                        <div style="clear: both; height:1px;"></div>
                                    <?php else: ?>
                                        <div style="clear: both; height: 9px;"></div>
                                    <?php endif; ?>

                                </ul>
                                <ul style="margin-left: 6px;">
                                    <li>
                                        <p>
                                            <?php echo link_to("Ver contribución", "contribucion/show?id=" . $contribucion->id) ?>
                                            <?php if ($contribucion->destacado): ?>
                                                <?php //echo link_to("Quitar destacado", "concurso/retirarcuncurso?concurso_id=" . $sf_request->getParameter('id') . "&contribucion_id=" . $contribucion->id) ?>
                                            <?php elseif ($contribucion->contribucion_estado_id == 2 && in_array($concurso->getConcursoEstadoId(), array(2, 3)) && $n_contribuciones_destacados < 10): ?>
                                                <?php //echo link_to("Destacar", "contribucion/destacar?contribucion_id=" . $contribucion->id) ?>
                                            <?php elseif ($contribucion->contribucion_estado_id == 2 && in_array($concurso->getConcursoEstadoId(), array(2, 3)) && $n_contribuciones_destacados >= 10): ?>
                                                <?php echo link_to_function("Destacar", "alert('No puedes destacar más de 10 contribuciones por concurso a la vez.')") ?>
                                            <?php endif; ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <hr/>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Este concurso no tiene contribuciones</p>
            <?php endif; ?>
        <?php endif; ?>
        <div style="clear: both"></div>
    </div>
    <div id="sf_admin_footer">
        <?php include_partial('concurso/list_footer') ?>
    </div>
</div>

<script type="text/javascript">
<?php if ($sf_user->hasFlash('alert')): ?>
        alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
</script>
<style type="text/css">
    #Asignacion_puntos_content {
        max-width: 548px;
    }
    .ver_link{ float:left;margin: 0px 0px 5px -19px; }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.featured').bind('click', function(){
            if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
                alert('<?php echo __('No puedes destacar más de diez concursos de Producto en la Home.') ?>');
                return false;
            }
        });
    });

</script>