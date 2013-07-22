<div id="sf_admin_container">
    <h1><?php echo __('Detalle de la Empresa/Entidad en Lista blanca', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <div id="concurso_actions" style="float: right">
                <ul>
                    <li class="sf_admin_action_featured">
                        <?php if (!$empresa->getFeatured()): ?>
                            <?php echo link_to(__('Home', array(), 'messages'), 'empresaListaBlanca/setFeatured?id=' . $empresa->getId(), array('class' => 'featured')) ?>
                        <?php else: ?>
                            <?php echo link_to(__('Quitar home', array(), 'messages'), 'empresaListaBlanca/removeFeatured?id=' . $empresa->getId(), array('class' => 'remove')) ?>
                        <?php endif; ?>
                    </li>
                    <li class="sf_admin_action_featured_order">
                        <?php echo link_to(__('Orden home', array(), 'messages'), 'empresaListaBlanca/setFeaturedOrder?id=' . $empresa->getId(), array()) ?>
                    </li>
                </ul>
            </div>
            <ul class="dragbox-content">
                <?php if ($empresa->getCreatedAt() != '') : ?>
                    <li><strong>Fecha: </strong><?php echo $empresa->getFCreatedAt("d/m/Y"); ?></li>
                <?php endif ?>
                <li><strong>Empresa/Entidad: </strong><?php echo $empresa; ?></li>
                <?php if ($empresa->getRoadType()->getId()) : ?>
                    <li><strong>Tipo de vía: </strong><?php echo $empresa->getRoadType(); ?></li>
                <?php endif ?>
                <?php if ($empresa->getDireccionCompleta() != '') : ?>
                    <li><strong>Direccion: </strong><?php echo $empresa->getDireccionCompleta(); ?></li>
                <?php endif ?>
                <?php if ($empresa->getStates()->getId()) : ?>
                    <li><strong>Provincia: </strong><?php echo $empresa->getStates(); ?></li>
                <?php endif ?>
                <li>
                    <strong>Localidad: </strong>
                    <?php if ($empresa->getStates() == 'Ceuta' || $empresa->getStates() == 'Melilla' || $empresa->getStates() == 'Toda España'): ?>
                        <?php echo $empresa->getStates(); ?>
                    <?php else: ?>
                        <?php echo $empresa->getMunicipioProvincia() ?>
                    <?php endif; ?>
                </li>
                <?php if ($empresa->getCodigoPostal() != '') : ?>
                    <li><strong>C.P.: </strong><?php echo $empresa->getCodigoPostal() ?></li>
                <?php endif ?>
                <?php if ($empresa->getPersonaContacto() != '') : ?>
                    <li><strong>Persona contacto: </strong><?php echo $empresa->getPersonaContacto() ?></li>
                <?php endif ?>

                <?php if ($empresa->getTelefono() != '') : ?>
                    <li><strong>Telefono: </strong><?php echo $empresa->getTelefono() ?></li>
                <?php endif ?>

                <?php if ($empresa->getEmail()) : ?>
                    <li><strong>Email: </strong><?php echo $empresa->getEmail() ?></li>
                <?php endif ?>
                <li><strong>Sector: </strong><?php echo $empresa->getEmpresaSectorUno() ?></li>
                <li><strong>Subsector: </strong><?php echo $empresa->getEmpresaSectorDos() ?></li>
                <?php if ($empresa->getEmpresaSectorTres()->getId()) : ?>
                    <li><strong>Actividad: </strong><?php echo $empresa->getEmpresaSectorTres() ?></li>
                <?php endif ?>

                <?php if ($empresa->getLista() == "lb"): ?>
                    <li><strong>Lista: </strong><?php echo __('Blanca', array(), 'messages'); ?></li>
                <?php elseif ($empresa->getLista() == "ln"): ?>
                    <li><strong>Lista: </strong><?php echo __('Negra', array(), 'messages'); ?></li>
                <?php else: ?>
                    <li><strong>Lista: </strong><?php echo __('Ninguna', array(), 'messages'); ?></li>
                <?php endif; ?>

                <?php if ($empresa->getFeatured() > 0): ?>
                    <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                    <?php if ($empresa->getFeaturedOrder() > 0): ?>
                        <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $empresa->getFeaturedOrder() ?></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($empresa->getLista() == "lb"): ?>
                    <?php if ($empresa->getRawValue()->getComentarioInicial()): ?>
                        <br/>
                        <li class="comment" style="margin-bottom: 5px;"><span class="bold">Comentario inicial:</span><p class="mr-span"> </p>
                            <div class="comenario_p">
                                <?php echo $empresa->getRawValue()->getComentarioInicial() ?>
                            </div>
                            <div class="clean_clear_blanca"></div>
                            <span class="ver_link">
                                <?php echo link_to('ver +', 'empresaListaBlanca/showComentarioInicial?id=' . $empresa->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'empresaListaBlanca/download_pdfComentario?id=' . $empresa->getId()) ?>
                            </span>
                        </li>
                    <?php endif; ?>
                <?php elseif ($empresa->getLista() == "ln"): ?>
                    <?php if ($empresa->getRawValue()->getTextoListaNegra()): ?>
                        <br/><br/>
                        <li class="comment" style="margin-bottom: 5px;"><strong>¿Por qué aparece aquí?: </strong><p class="mr-span"> </p><?php echo $empresa->getRawValue()->getTextoListaNegra() ?>
                            <br/>
                            <span class="ver_link">
                                <?php echo link_to('ver +', 'empresaListaBlanca/showListaNegraPor?id=' . $empresa->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'empresaListaBlanca/download_pdf?id=' . $empresa->getId()) ?>
                            </span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if ($empresa->getRawValue()->getComentarioInicial()): ?>
                <div class="clean_clear_0_blanca"></div>
            <?php endif; ?>

            <ul class="dragbox-content" style="float:left; width: 99%; margin-top: 0px;">
                <?php if ($empresa->getLista() == "lb"): ?>
                    <li>
                        <strong>Medalla:</strong>
                        <?php echo ucfirst($empresa->getMedalla()); ?>
                    </li>
                <?php else: ?>
                    <li>
                        <strong>Categoria excelencia:</strong>
                        <?php echo ucfirst($empresa->getMedalla()); ?>
                    </li>
                <?php endif; ?>
                <li><strong>Cuestionario asociado:</strong> <a
                        href='<?php echo url_for('cuestionario_show', array('id' => $empresa->getCuestionario()->getId())) ?>'><?php echo $empresa->getCuestionario()->getNombre() ?></a>
                </li>
                <li><strong>Puntos totales:</strong> <?php echo $empresa->getDividendo() ?></li>
                <li><strong>Auditorías realizadas:</strong> <?php echo $empresa->getDivisor() ?></li>
                <?php if ($empresa->getConcursoDestacado()->getId()) : ?>
                    <li><strong>Concurso asociado: </strong><a
                            href='<?php echo url_for('concurso_show', array('id' => $empresa->getConcursoDestacado()->getid())) ?>'><?php echo $empresa->getConcursoDestacado() ?></a>
                    </li>
                <?php endif ?>
            </ul>

            <div class="clean_clear_0_blanca"></div>
            <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                <li><strong><h3 style="margin-top: 0em !important;">Auditorías realizadas</h3></strong></li>
            </ul>
            <?php if (count($pager->getResults()) > 0): ?>
                <ul class="empresa_ul_audit">
                    <?php $c = (($sf_request->getParameter('page', 1) - 1) * 25) + 1; ?>
                    <?php foreach ($pager->getResults() as $respuesta): ?>
                        <li class="empresa_audit">
                            <span class="empresa_number">
                                <span style="float: left; padding: <?php echo ($c >= 1 && $c >= 10) ? '1px 0 0 0;' : '1px 0 0 7px;' ?>"><?php echo $c; ?></span>)
                                <?php $c++; ?>
                            </span>
                            <span class="empresa_date">
                                <?php echo $respuesta->getDateTimeObject('created_at')->format('d/m/Y '); ?>
                            </span>
                            <span class="empresa_user_name">
                                <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $respuesta->getUser()->getId()) ?>'>
                                    <?php echo $respuesta->getUser() ?></a>.
                            </span>
                            <span class="empresa_pun_total">
                                <strong>Puntuación total: </strong><?php echo $respuesta->getPuntos(); ?>
                            </span>
                            <?php if ($respuesta->getRawValue()->getComentario() == '') : ?>
                                <strong><?php echo $respuesta->getDisabled() ? '<span class="alert" style="padding-left: 127px;">Auditoría desactivada</span>' : '' ?></strong>
                            <?php elseif ($respuesta->getRawValue()->getComentario() != '') : ?>
                                <strong><?php echo $respuesta->getDisabled() ? '<span class="alert" style="padding-left: 2px;">Auditoría desactivada</span>' : '' ?></strong>
                            <?php endif; ?>
                            <span class="empresa_comentario">
                                <?php if ($respuesta->getRawValue()->getComentario() != '') : ?>
                                    <a class='display_comments' href='#ver_comentario'>Ver comentario</a>
                                    <div style='display:none'><?php echo $respuesta->getRawValue()->getComentario() ?></div>
                                <?php endif ?>
                            </span>
                            <?php if (!$respuesta->getDisabled()) : ?>
                                <a class='ajax_actions check' id='delete' title='¿Seguro que quieres anular esta auditoría?'
                                   href='<?php echo url_for('delete_cuestionario', array('id' => $respuesta->getId())) ?>'>Anular</a>
                               <?php endif ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($pager->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'empresaListaBlanca/show?page=' . $pager->getFirstPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'empresaListaBlanca/show?page=' . $pager->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'empresaListaBlanca/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $empresa->id) ?>
                        <?php if ($page != $pager->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'empresaListaBlanca/show?page=' . $pager->getNextPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'empresaListaBlanca/show?page=' . $pager->getLastPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                </div>

            <?php endif; ?>

            <?php if (count($pager_pending) > 0) : ?>
                <div class="clean_clear_1_blanca"></div>
                <ul class="dragbox-content" style="float:left; width:98%; min-height: 0px;">
                    <li style="float:left; width:98%;"><h3 style="margin: 0;">Auditorías pendientes</h3></strong></li>
                </ul>
                <h4 style="float: left; width:97%; margin: 4px 0 0 26px">
                    <?php echo format_number_choice('[0]No hay auditorías pendientes|[1]Hay 1 auditoría pendiente|[2,+Inf] Hay %n% auditorías pendientes', array('%n%' => count($pager_pending)), count($pager_pending)); ?></h4>
                <ul class="empresa_ul_comment_audit">
                    <?php $c = (($sf_request->getParameter('pg', 1) - 1) * 25) + 1; ?>
                    <?php foreach ($pager_pending as $respuesta) : ?>
                        <?php include_partial('empresa/tableCuestionarios', array('respuesta' => $respuesta, 'c' => $c)) ?>
                        <?php $c++; ?>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

            <?php if ($pager_pending->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager_pending->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'empresaListaBlanca/show?pg=' . $pager_pending->getFirstPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'empresaListaBlanca/show?pg=' . $pager_pending->getPreviousPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php foreach ($pager_pending->getLinks() as $page): ?>
                        <?php echo ($page == $pager_pending->getPage()) ? $page : link_to($page, 'empresaListaBlanca/show?pg=' . $page . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $empresa->id) ?>
                        <?php if ($page != $pager_pending->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'empresaListaBlanca/show?pg=' . $pager_pending->getNextPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'empresaListaBlanca/show?pg=' . $pager_pending->getLastPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                </div>

            <?php endif; ?>
            <?php if (count($pager->getResults()) > 0): ?>
                <div class="clean_clear_1_blanca"></div>
            <?php else: ?>
                <div class="clean_clear_blanca_1"></div>
            <?php endif; ?>
            <ul class="dragbox-content" style="float: left; width: 99%; min-height: 0px;">
                <li style="float:left; width: 98%;"><strong><h3 style="margin: 0;">KPIs</h3></strong></li>
            </ul>
            <?php include_partial('categoriaExcelencia', array('kpis' => $empresa->getKpis())) ?>
        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista blanca', '@empresa_lista_blanca', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'empresa_lista_blanca_edit', array('id' => $empresa->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .empresa_ul_audit{
        float: left;
        margin: 0 0 0 25px;
        min-height: 50px;
    }
    .empresa_ul_comment_audit{
        float: left;
        margin: 12px 0 0 25px;
        min-height: 0px; 
    }
    .empresa_audit{
        float: left;
        width: 100%;
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
    .empresa_pun_total{
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
        margin: 5px 0 10px 25px;
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
        width: 23px;
    }
    .empresa_kpi{
        padding-left: 16px !important;
    }
    #sf_admin_container ul.sf_admin_actions { 
        float: left; 
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    .ver_link{
        float: left;
        /*float: left; width: 100%; */
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        /*float: left;*/
        width: 100%;
    }
    .comenario_p p{
        margin: 0;
    }
    .ui-dialog #dialog ul li{ list-style: disc; }
</style>
<script type='text/javascript'>


    $('.display_comments').click(function () {
        dialog = $('#dialog');
        if (dialog.length == 0) {
            dialog = $('<div/>', {
                id:'dialog'
            });
        }
        dialog.html($(this).next().html());
        dialog.dialog({ title:'Auditoría del consumidor', width:400, height:250});

        return false;

    });

    $('.ajax_actions').click(function () {
        var that = $(this);
        if (that.hasClass('check')) {
            if (!confirm(this.title)) {
                return false;
            }
        }
        $.post($(this).attr('href'), function (data) {
            that.closest('li').fadeOut();
            window.location.reload();
        });
        return false;
    })
</script>
<script type="text/javascript">
<?php if ($sf_user->hasFlash('alert')): ?>
        alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
    $(document).ready(function(){
        $('.featured').bind('click', function(){
            if('<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>'){
                alert('<?php echo __('No puedes destacar más de 10 empresas o entidades de la Lista blanca en la Home.') ?>');
                return false;
            }
        });
    })
</script>