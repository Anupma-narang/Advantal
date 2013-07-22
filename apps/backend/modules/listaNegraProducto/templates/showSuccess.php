<div id="sf_admin_container">
    <h1><?php echo __('Detalle del Producto en Lista negra', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <div id="concurso_actions" style="float: right">
                <ul>
                    <li class="sf_admin_action_featured">

                        <?php if (!$producto->getFeatured()): ?>
                            <?php echo link_to(__('Home', array(), 'messages'), 'listaNegraProducto/setFeatured?id=' . $producto->getId(), array('class' => 'featured')) ?>
                        <?php else: ?>
                            <?php echo link_to(__('Quitar home', array(), 'messages'), 'listaNegraProducto/removeFeatured?id=' . $producto->getId(), array('class' => 'remove')) ?>
                        <?php endif; ?>
                    </li>
                    <li class="sf_admin_action_featured_order">
                        <?php echo link_to(__('Orden home', array(), 'messages'), 'listaNegraProducto/setFeaturedOrder?id=' . $producto->getId(), array()) ?>
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
                <?php if ($producto->getLista() == "lb"): ?>
                    <li><strong>Lista: </strong><?php echo __('Blanca', array(), 'messages'); ?></li>
                <?php elseif ($producto->getLista() == "ln"): ?>
                    <li><strong>Lista: </strong><?php echo __('Negra', array(), 'messages'); ?></li>
                <?php else: ?>
                    <li><strong>Lista: </strong><?php echo __('Ninguna', array(), 'messages'); ?></li>
                <?php endif; ?>
                <li><strong>Comentarios: </strong>
                    <?php $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId(); ?>
                    <?php echo $producto->getCountComments($user_id); ?>
                </li>
                <?php if ($producto->getFeatured() > 0): ?>
                    <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                    <?php if ($producto->getFeaturedOrder() > 0): ?>
                        <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $producto->getFeaturedOrder() ?></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($producto->getRawValue()->getTextoListaNegra()): ?>
                    <br/>
                    <li class="comment" style="margin-bottom: 5px;"><span class="bold">¿Por qué aparece aquí?: </span><p class="mr-span"> </p><?php echo $producto->getRawValue()->getTextoListaNegra() ?>
                        <div class="clean_clear_negra"></div>  
                        <span class="ver_link">      
                            <?php echo link_to('ver +', 'listaNegraProducto/showListaNegraPor?id=' . $producto->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                            <?php //echo link_to('descargar pdf', 'listaNegraProducto/download_pdf?id=' . $producto->getId()) ?>
                        </span>
                    </li>
                <?php endif ?>
            </ul>

            <div class="clean_clear_0_negra"></div>
            <?php if ($producto->getConcursoDestacado()->getId()) : ?>
                <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                    <li><strong>Concurso: </strong><a
                            href='<?php echo url_for('concurso_show', array('id' => $producto->getConcursoDestacado()->getId())) ?>'><?php echo $producto->getConcursoDestacado() ?></a>
                    </li>
                </ul>
            <?php endif ?>

            <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                <li style="width: 98%;"><h3>Comentarios</h3></li>
            </ul>
            <ul class='alerta_cuestionario'>
                <?php $c = (($sf_request->getParameter('page', 1) - 1) * 25) + 1; ?>
                <?php foreach ($pager as $comentario) : ?>
                    <?php include_partial('listaNegraProducto/comentario', array('comentario' => $comentario, 'c' => $c)); ?>
                    <?php $c++; ?>
                <?php endforeach ?>
            </ul>

            <?php if ($pager->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'listaNegraProducto/show?page=' . $pager->getFirstPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'listaNegraProducto/show?page=' . $pager->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'listaNegraProducto/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $producto->id) ?>
                        <?php if ($page != $pager->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'listaNegraProducto/show?page=' . $pager->getNextPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'listaNegraProducto/show?page=' . $pager->getLastPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $producto->id) ?>
                </div>

            <?php endif; ?>

            <?php if (count($pager_pending) > 0) : ?>
                <div class="clean_clear_1_negra"></div>
                <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px; margin: 5px 5px 0;">
                    <li style="width: 98%;"><h3 style="padding: 1px 0 0 0;">Comentarios pendientes</h3></li>
                </ul>
                <h4 style="float: left; width:97%; margin: 3px 0 0 26px;">
                    <?php echo format_number_choice('[0]No hay comentarios pendientes|[1]Hay 1 comentario pendiente|[2,+Inf] Hay %n% comentarios pendientes', array('%n%' => count($pager_pending)), count($pager_pending)); ?></h4>
                <ul style="float: left; width: 99%; margin: 12px 0 0 12px;">
                    <?php $c = (($sf_request->getParameter('page', 1) - 1) * 25) + 1; ?>
                    <?php foreach ($pager_pending as $comentario) : ?>
                        <?php include_partial('listaNegraProducto/comentario', array('comentario' => $comentario, 'c' => $c)); ?>
                        <?php $c++; ?>
                    <?php endforeach ?>
                </ul>

            <?php endif ?>

            <?php if ($pager_pending->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager_pending->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'listaNegraProducto/show?pg=' . $pager_pending->getFirstPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'listaNegraProducto/show?pg=' . $pager_pending->getPreviousPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php foreach ($pager_pending->getLinks() as $page): ?>
                        <?php echo ($page == $pager_pending->getPage()) ? $page : link_to($page, 'listaNegraProducto/show?pg=' . $page . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $producto->id) ?>
                        <?php if ($page != $pager_pending->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'listaNegraProducto/show?pg=' . $pager_pending->getNextPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'listaNegraProducto/show?pg=' . $pager_pending->getLastPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $producto->id) ?>
                </div>

            <?php endif; ?>

            <ul class='sf_admin_actions'>
                <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@producto', array('class' => 'sf_admin_action_cancel')) ?></li>
                <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista negra', '@producto_listaNegraProducto', array('class' => 'sf_admin_action_cancel')) ?></li>
                <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'producto_listaNegraProducto_edit', array('id' => $producto->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
            </ul>

        </div>

    </div>
</div>
<style type="text/css">
    .sf_admin_actions{
        float: left;
    }
    .producto_ul_audit{
        float: left;
        margin: 0 0 0 11px;
        min-height: 50px;
    }
    .producto_audit{
        float: left;
        width: 98%;
        margin-left: 12px;
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
    .producto_ver_comment{
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
        margin: 5px 0 10px 26px;
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
        width: 23px;
    }
   #sf_admin_container ul.sf_admin_actions { 
        float: left;
        width: 99%;
        margin: 10px 10px 0px 6px !important;
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
        dialog.dialog({ title:'Comentario del consumidor', width:400, height:250});

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
    $(document).ready(function() {
        $('.featured').bind('click', function(){
            if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
                alert('<?php echo __('No puedes destacar más de 10 productos de la Lista negra en la Home.') ?>');
                return false;
            }
        });
    });
</script>