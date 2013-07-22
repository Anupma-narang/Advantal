
<?php use_helper('I18N', 'Date', 'Text') ?>
<?php //include_partial('contribucion/assets')                                             ?>
<div id="sf_admin_container">

    <h1>Detalle de la contribución destacada</h1>


    <div id="sf_admin_content">
        <?php include_partial('contribuciones_destacadas/flashes') ?>

        <div id="sf_admin_header">
            <?php include_partial('contribuciones_destacadas/list_header') ?>
        </div>



        <div id="concurso_actions" style="float:right">
            <?php include_partial("contribuciones_destacadas/actions", array("contribucion" => $contribucion, "helper" => $helper, 'n_contribuciones_destacados' => $n_contribuciones_destacados)) ?>
        </div>

        <h2><?php echo __($contribucion->name, array(), 'messages') ?></h2>
        <ul class="dragbox-content">
            <li><span class="bold">Fecha</span>: <?php echo format_datetime($contribucion->getCreatedAt(), "dd/MM/y", "es_ES") ?></li>
            <li><span class="bold">Usuario</span>: <?php echo $contribucion->User->username ?></li>
            <li><span class="bold">Concurso asociado</span>: <?php echo link_to($contribucion->Concurso->name, "concurso/show?id=" . $contribucion->Concurso->id) ?></li>
            <?php if ($contribucion->principal): ?>
                <li><strong>Esta es la contribución inicial del concurso</span>: <?php echo $contribucion->Concurso->name ?></strong></li>
            <?php endif; ?>
            <li><span class="bold">Estado contribución</span>: 
                <?php
                if ($contribucion->getConcurso()->getConcursoEstadoId() == 4)
                    echo 'Deliberación';
                else
                    echo $contribucion->ContribucionEstado->name
                    ?>
            </li>
            <br>
            <li style="float: left; width: 990px;">
                <span class="bold">Descripción de la incidencia</span>: 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->incidencia) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">               
                    <?php echo link_to('ver +', 'contribuciones_destacadas/showIncidencia?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear: both; height: 12px;"></div>
            <li>
                <span class="bold">Resumen del Plan de acción</span>: 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->resumen) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">                  
                    <?php echo link_to('ver +', 'contribuciones_destacadas/showResumen?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear: both; height: 22px;"></div>
            <li>
                <span class="bold">Plan de acción</span>: 
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contribucion->plan_accion) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">                  
                    <?php echo link_to('ver +', 'contribuciones_destacadas/showPlanAccion?id=' . $contribucion->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
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
                        ?></ul>
                <?php endif; ?>
            </li>
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
            <?php if (!$contribucion->getVotosTotales() > 0 && !$contribucion->getPuntosTotales() > 0): ?>
                <div style="clear: both; height: 50px;"></div>
            <?php else: ?>
                <div style="clear: both; height: 22px;"></div>
            <?php endif; ?>
            <div id="Asignacion_puntos_content" style="margin-left: 8px;">
                <h2>Asignación de puntos</h2>
                <div id="Asignacion_puntos_inner">
                    <form id="Puntos_form" action="<?php echo url_for('contribuciones_destacadas/changeStatus?id=' . $contribucion->getId()) ?>" method="get">
                        <input type="hidden" name="estado" value="2">
                        <input type="hidden" name="siguiente" value="0" id="Siguiente">
                        <table>
                            <tbody>
                                <?php $c = 1 ?>			
                                <?php foreach ($puntos as $p): ?>
                                    <tr>
                                        <td><input type="checkbox" name="<?php echo $p->getCodigo() ?>"
                                                   value="true"></td>
                                        <td><?php echo $p->getDescripcion() ?></td>
                                        <td style="text-align:right;"><strong><?php echo number_format($p->puntos, 0, '.', '.'); ?></strong></td>
                                    </tr>			
                                    <?php $c++ ?>			
                                <?php endforeach; ?>
                                <tr>
                                    <th>Otro</th>
                                    <td><input type="text" name="otro_descripcion" size="40" id="Otro_descripcion"></td>
                                    <td><input type="text" name="otro_puntos" size="10" id="Otro_puntos"></td>
                                </tr>			
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div style="clear:both; height: 3px;"></div>
        <?php endif; ?>  
        <ul class='sf_admin_actions' style="margin-left: 6px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@contribuciones_destacadas', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="sf_admin_footer">
        <?php include_partial('contribuciones_destacadas/list_footer') ?>
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


<script type="text/javascript">
  $(".pagination a").click(function(){
    var page= $(this).attr('id').split('_');
    page =page[1];
    $("#page").val(page);
    window.location='<?php echo url_for('contribuciones_destacadas/show?id='.$sf_params->get('id').'&page=');?>'+page;
  });
</script>