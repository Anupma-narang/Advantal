<div id="sf_admin_container">
    <h1><?php echo __('Detalle del Producto en Lista blanca', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <div id="concurso_actions" style="float: right">
                <ul>
                    <li class="sf_admin_action_featured">

                        <?php if (!$producto->getFeatured()): ?>
                            <?php echo link_to(__('Home', array(), 'messages'), 'productoListaBlanca/setFeatured?id=' . $producto->getId(), array('class' => 'featured')) ?>
                        <?php else: ?>
                            <?php echo link_to(__('Quitar home', array(), 'messages'), 'productoListaBlanca/removeFeatured?id=' . $producto->getId(), array('class' => 'remove')) ?>
                        <?php endif; ?>
                    </li>
                    <li class="sf_admin_action_featured_order">
                        <?php echo link_to(__('Orden home', array(), 'messages'), 'productoListaBlanca/setFeaturedOrder?id=' . $producto->getId(), array()) ?>
                    </li>
                </ul>
            </div>
            <ul class="dragbox-content">
                <li><strong>Producto: </strong><?php echo $producto; ?></li>
                <li><strong>Marca: </strong><?php echo $producto->getMarca(); ?></li>
                <?php if ($producto->getModelo() != '') : ?>
                    <li><strong>Modelo: </strong><?php echo $producto->getModelo() ?></li>
                <?php endif ?>

                <?php if ($producto->getPersonaContacto() != '') : ?>
                    <li><strong>Persona contacto: </strong><?php echo $producto->getPersonaContacto() ?></li>
                <?php endif ?>

                <?php if ($producto->getPersonaContacto() != '') : ?>
                    <li><strong>Persona contacto: </strong><?php echo $producto->getPersonaContacto() ?></li>
                <?php endif ?>

                <?php if ($producto->getTelefono() != '') : ?>
                    <li><strong>Teléfono: </strong><?php echo $producto->getTelefono() ?></li>
                <?php endif ?>

                <?php if ($producto->getEmail()) : ?>
                    <li><strong>Email: </strong><?php echo $producto->getEmail() ?></li>
                <?php endif ?>


                <li><strong>Sector: </strong><?php echo $producto->getProductoTipoUno() ?></li>
                <li><strong>Subsector: </strong><?php echo $producto->getProductoTipoDos() ?></li>
                <?php if ($producto->getProductoTipoTres()->getId()) : ?>
                    <li><strong>Tipo de producto: </strong><?php echo $producto->getTipo() ?></li>
                <?php endif ?>
                <li><strong>Lista: </strong>
                    <?php if ($producto->getLista() == "lb"): ?>
                        <?php echo __('Blanca', array(), 'messages'); ?>
                    <?php elseif ($producto->getLista() == "ln"): ?>
                        <?php echo __('Negra', array(), 'messages'); ?>
                    <?php else: ?>
                        <?php echo __('Ninguna', array(), 'messages'); ?>
                    <?php endif; ?>
                </li>                    
                <?php if ($producto->getFeatured() > 0): ?>
                    <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                    <?php if ($producto->getFeaturedOrder() > 0): ?>
                        <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $producto->getFeaturedOrder() ?></li>
                    <?php endif; ?>
                <?php endif; ?>


                <?php if ($producto->getLista() == "lb"): ?>
                    <?php if ($producto->getRawValue()->getComentarioInicial()): ?>
                        <br/>
                        <li class="comment" style="margin-bottom: 5px;"><span class="bold">Comentario inicial:</span><p class="mr-span"> </p>
                            <div class="comenario_p">
                                <?php echo $producto->getRawValue()->getComentarioInicial() ?>
                            </div>
                            <div class="clean_clear_blanca"></div>  
                            <span class="ver_link">      
                                <?php echo link_to('ver +', 'productoListaBlanca/showComentarioInicial?id=' . $producto->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'productoListaBlanca/download_pdfComentario?id=' . $producto->getId()) ?>
                            </span>
                        </li>  
                    <?php endif; ?>
                <?php elseif ($producto->getLista() == "ln"): ?>
                    <?php if ($producto->getRawValue()->getTextoListaNegra()): ?>
                        <br/>    
                        <li class="comment" style="margin-bottom: 5px;"><strong>¿Por qué aparece aquí?: </strong><p class="mr-span"> </p><?php echo $producto->getRawValue()->getTextoListaNegra() ?>
                            <br/>
                            <span class="ver_link">      
                                <?php echo link_to('ver +', 'productoListaBlanca/showListaNegraPor?id=' . $producto->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'productoListaBlanca/download_pdf?id=' . $producto->getId()) ?>
                            </span>
                        </li>
                        <br/>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if ($producto->getRawValue()->getComentarioInicial()): ?>
                <div class="clean_clear_0_blanca"></div>
            <?php endif; ?>

            <ul class="dragbox-content" style="float:left; width: 99%; margin-top: 0px;">
                <?php if ($producto->getLista() == "lb"): ?>
                    <li>
                        <strong>Medalla:</strong>
                        <?php echo ucfirst($producto->getMedalla()); ?>
                    </li>
                <?php else: ?>
                    <li>
                        <strong>Categoria excelencia:</strong> 
                        <?php echo ucfirst($producto->getMedalla()); ?>
                    </li>
                <?php endif; ?>
                <li><strong>Cuestionario asociado:</strong> <a
                        href='<?php echo url_for('cuestionario_show', array('id' => $producto->getCuestionario()->getId())) ?>'><?php echo $producto->getCuestionario()->getNombre() ?></a>
                </li>
                <li><strong>Puntos totales:</strong> <?php echo $producto->getDividendo() ?></li>
                <li><strong>Auditorías realizadas:</strong> <?php echo $producto->getDivisor() ?></li>
                <?php if ($producto->getConcursoDestacado()->getId()) : ?>

                    <li><strong>Concurso asociado: </strong><a
                            href='<?php echo url_for('concurso_show', array('id' => $producto->getConcursoDestacado()->getId())) ?>'><?php echo $producto->getConcursoDestacado() ?></a>
                    </li>
                <?php endif ?>
            </ul>
            <div class="clean_clear_0_blanca"></div>
            <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                <li><strong><h3 style="margin-top: 0em !important;">Auditorías realizadas</h3></strong></li>
            </ul>
            <?php if (count($pager->getResults()) > 0): ?>
                <ul class="producto_ul_audit">
                    <?php $c = (($sf_request->getParameter('page', 1) - 1) * 25) + 1; ?>
                    <?php foreach ($pager->getResults() as $respuesta): ?>
                        <li class="producto_audit">
                            <span class="producto_number">
                                <span style="float: left; padding: <?php echo ($c >= 1 && $c >= 10) ? '1px 0 0 0;' : '1px 0 0 8px;' ?>"><?php echo $c; ?></span>)
                                <?php $c++; ?>
                            </span>
                            <span class="producto_date">
                                <?php echo $respuesta->getDateTimeObject('created_at')->format('d/m/Y'); ?>
                            </span>
                            <span class="producto_user_name">
                                <a href='<?php echo url_for('sfguarduser/List_ver?id=' . $respuesta->getUser()->getId()) ?>'>
                                    <?php echo $respuesta->getUser() ?></a>.
                            </span>
                            <span class="producto_pun_total">
                                <strong>Puntuación total: </strong><?php echo $respuesta->getPuntos(); ?>
                            </span>
                            <?php if ($respuesta->getRawValue()->getComentario() == '') : ?>
                                <strong><?php echo $respuesta->getDisabled() ? '<span class="alert" style="padding-left: 127px;">Auditoría desactivada</span>' : '' ?></strong>
                            <?php elseif ($respuesta->getRawValue()->getComentario() != '') : ?>
                                <strong><?php echo $respuesta->getDisabled() ? '<span class="alert" style="padding-left: 2px;">Auditoría desactivada</span>' : '' ?></strong>
                            <?php endif; ?>
                            <span class="producto_comentario">
                                <?php if ($respuesta->getRawValue()->getComentario() != '') : ?>
                                    <a class='display_comments' href='#ver_comentario'>Ver comentario</a>
                                    <div style='display:none'><?php echo $respuesta->getRawValue()->getComentario() ?></div>
                                <?php endif ?>
                            </span>
                            <?php if (!$respuesta->getDisabled()) : ?>
                                <a class='ajax_actions check' id='delete' title='¿Seguro que quieres anular esta auditoría?'
                                   href='<?php echo url_for('delete_cuestionario_producto', array('id' => $respuesta->getId())) ?>'>Anular</a>
                               <?php endif ?>
                        </li>

                    <?php endforeach ?>
                </ul>
            <?php endif; ?>

            <?php if ($pager->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'productoListaBlanca/show?page=' . $pager->getFirstPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'productoListaBlanca/show?page=' . $pager->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'productoListaBlanca/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $producto->id) ?>
                        <?php if ($page != $pager->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'productoListaBlanca/show?page=' . $pager->getNextPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'productoListaBlanca/show?page=' . $pager->getLastPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                </div>

            <?php endif; ?>

            <?php if (count($pager_pending) > 0) : ?>
                <div class="clean_clear_1_blanca"></div>
                <ul class="dragbox-content" style="float:left; width:98%; min-height: 0px;">
                    <li style="float:left; width:98%;"><h3 style="margin: 0;">Auditorías pendientes</h3></strong></li>
                </ul>
                <h4 style="float: left; width:97%; margin: 4px 0 0 26px">
                    <?php echo format_number_choice('[0]No hay auditorías pendientes|[1]Hay 1 auditoría pendiente|[2,+Inf] Hay %n% auditorías pendientes', array('%n%' => count($pager_pending)), count($pager_pending)); ?></h4>
                <ul class="producto_ul_comment_audit"> 
                    <?php $c = (($sf_request->getParameter('pg', 1) - 1) * 25) + 1; ?>
                    <?php foreach ($pager_pending as $respuesta) : ?>
                        <?php include_partial('producto/tableCuestionarios', array('respuesta' => $respuesta, 'c' => $c)) ?>
                        <?php $c++; ?>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

            <?php if ($pager_pending->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager_pending->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'productoListaBlanca/show?pg=' . $pager_pending->getFirstPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'productoListaBlanca/show?pg=' . $pager_pending->getPreviousPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php foreach ($pager_pending->getLinks() as $page): ?>
                        <?php echo ($page == $pager_pending->getPage()) ? $page : link_to($page, 'productoListaBlanca/show?pg=' . $page . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $producto->id) ?>
                        <?php if ($page != $pager_pending->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'productoListaBlanca/show?pg=' . $pager_pending->getNextPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'productoListaBlanca/show?pg=' . $pager_pending->getLastPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
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
            <?php include_partial('categoriaExcelencia', array('kpis' => $producto->getKpis())) ?>
        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@producto', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista blanca', '@producto_lista_blanca', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'producto_lista_blanca_edit', array('id' => $producto->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .producto_ul_comment_audit{ float: left;margin: 12px 0 0 25px;min-height: 0px; }
    .producto_ul_audit{
        float: left;
        margin: 0 0 0 24px;
        min-height: 50px;
    }
    .producto_audit{
        float: left;
        width: 100%;
    }
    .producto_date{
        float: left;
        width: 135px;
    }
    .producto_user_name{
        float: left;
        width: 200px;
        padding-right: 35px;
    }
    .producto_pun_total{
        float: left;
        width: 150px;
    }
    .producto_comentario{
        float: left;
        width: 125px;
    }
    .producto_comment_aprobar{
        float: left;
        width: 200px;
    }
    .producto_aprobar{
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
    .producto_number{
        float: left;
        margin-top: -1px;
        width: 24px;
    }
    .producto_kpi{
        padding-left: 16px !important; 
    }
    #sf_admin_container ul.sf_admin_actions { 
        float: left;
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    #sf_admin_theme_footer{
        float: left;
        margin: 0;
        padding: 0;
        text-align: center;
        width: 100%;
    }
    .ver_link{
        float: left;
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        width: 100%;
    }
    .ui-dialog #dialog ul li{ list-style: disc;}
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
    $(document).ready(function(){
        $('.featured').bind('click', function(){
            if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
                alert('<?php echo __('No puedes destacar más de 10 productos de la Lista blanca en la Home.') ?>');
                return false;
            }
        });
    });
</script>