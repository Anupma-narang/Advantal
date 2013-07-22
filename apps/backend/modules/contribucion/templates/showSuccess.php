<?php use_helper('I18N', 'Date', 'Text') ?>
<?php include_partial('contribucion/assets') ?>
<div id="sf_admin_container">

    <h1>Detalle de la contribución</h1>


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
            <li><strong>Fecha:</strong> <?php echo format_datetime($contribucion->getCreatedAt(), "dd/MM/y", "es_ES") ?></li>
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
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'contribucion/showIncidenciaDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
                <?php //echo link_to('descargar pdf', 'contribucion/Download_pdfIncidencia?id=' . $contribucion->getId())   ?>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Resumen del Plan de acción:</strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->resumen) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'contribucion/showResumen?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li><strong>Plan de acción:</strong>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->plan_accion) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'contribucion/showPlanAccionDetail?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
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
                </li>
            <?php endif; ?>
            <?php if ($contribucion->getVotosTotales() > 0 || $contribucion->getPuntosTotales() > 0): ?>
                <div style="clear: both; height: 22px;"></div>
                <li><?php if ($contribucion->getVotosTotales() > 0): ?><span class="bold">Votos recibidos</span>: <?php echo $contribucion->getVotosTotales() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
                    <?php if ($contribucion->getPuntosTotales() > 0): ?><span class="bold">Puntos conseguidos</span>: <?php echo $contribucion->getPuntosTotales() ?><?php endif; ?>
                    <?php if ($contribucion->getVotosTotales()): ?>

                      <?php if (count($pager->getResults()) > 0): ?>
                          <ul style="margin-top:25px;">
                              <?php foreach ($pager->getResults() as $i => $voto): ?>
                                  <li style="margin:0px;"><?php echo format_number_choice('[0]El usuario %user% ha dado 0 puntos|[1]El usuario %user% ha dado 1 punto|(1,+Inf]El usuario %user% ha dado %count% puntos', array('%user%' => $voto->sfGuardUser->username, '%count%' => $voto->value), $voto->value) ?><br /><br /></li>
                              <?php endforeach; ?>
                          </ul>                    
                      <?php endif; ?>
                    <?php endif; ?>                    
                </li>
            <?php endif; ?>
        </ul>
        <?php if ($pager->haveToPaginate()): ?>
          <div class="pagination" style="text-align:left">
              <a href="javascript:void(0);" id="page_<?php echo $pager->getFirstPage()?>"><?php echo image_tag('/images/first.png', array('title' => 'Primera')); ?></a>
              <a href="javascript:void(0);" id="page_<?php echo $pager->getPreviousPage(); ?>"><?php echo image_tag('/images/previous.png', array('title' => 'Anterior')); ?></a>
              <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                  <?php echo $page ?>
                <?php else: ?>
                  <a href="javascript:void(0);" id="page_<?php echo $page ?>"><?php echo $page ?></a>
                <?php endif; ?>
              <?php endforeach; ?>

              <a id="page_<?php echo $pager->getNextPage() ?>" href="javascript:void(0);">
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?>
              </a>

              <a id="page_<?php echo $pager->getLastPage(); ?>" href="javascript:void(0);">
                <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?>
              </a>
          </div>
        <?php endif; ?>
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
        <?php else: ?>
            <div style="clear: both; height: 3px;"></div>
        <?php endif; ?>
        <ul class='sf_admin_actions' style="margin-left: 6px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@contribucion', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="sf_admin_footer">
        <?php include_partial('contribucion/list_footer') ?>
    </div>
</div>

<?php // echo $sf_params->get('id');exit;?>

<form method="POST" id="frm" action="<?php echo url_for('contribucion/show?id='.$sf_params->get('id'))?>">
  <input type="hidden" name="page" id="page" />
</form>


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

<script type="text/javascript">
  $(".pagination a").click(function(){
    var page= $(this).attr('id').split('_');
    page =page[1];
    $("#page").val(page);
    window.location='<?php echo url_for('contribucion/show?id='.$sf_params->get('id').'&page=');?>'+page;    
  });
</script>