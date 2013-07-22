<div id="sf_admin_container">
    <h1><?php echo __('Detalle de la Empresa/Entidad en Lista negra', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <div id="concurso_actions" style="float: right">
                <ul>
                    <li class="sf_admin_action_featured">

                        <?php if (!$empresa->getFeatured()): ?>
                            <?php echo link_to(__('Home', array(), 'messages'), 'listaNegraEmpresa/setFeatured?id=' . $empresa->getId(), array('class' => 'featured')) ?>
                        <?php else: ?>
                            <?php echo link_to(__('Quitar home', array(), 'messages'), 'listaNegraEmpresa/removeFeatured?id=' . $empresa->getId(), array('class' => 'remove')) ?>
                        <?php endif; ?>
                    </li>
                    <li class="sf_admin_action_featured_order">
                        <?php echo link_to(__('Orden home', array(), 'messages'), 'listaNegraEmpresa/setFeaturedOrder?id=' . $empresa->getId(), array()) ?>
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
                <li><strong>Localidad: </strong><?php echo $empresa->getMunicipioProvincia() ?></li>
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
                <li><strong>Comentarios: </strong>
                    <?php $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId(); ?>
                    <?php echo $empresa->getCountComments($user_id); ?>
                </li>
                <?php if ($empresa->getFeatured() > 0): ?>
                    <li><span class="blod"><?php echo __('Home') ?>:&nbsp;</span>Si</li>
                    <?php if ($empresa->getFeaturedOrder() > 0): ?>
                        <li><span class="blod"><?php echo __('Orden Home') ?>:&nbsp;</span><?php echo $empresa->getFeaturedOrder() ?></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($empresa->getLista() == "ln"): ?>
                    <?php if ($empresa->getRawValue()->getTextoListaNegra()): ?>
                        <br/>
                        <li class="comment" style="margin-bottom: 5px;"><span class="bold">¿Por qué aparece aquí?: </span><p class="mr-span"> </p><?php echo $empresa->getRawValue()->getTextoListaNegra() ?>
                            <div class="clean_clear_negra"></div>
                            <span class="ver_link">
                                <?php echo link_to('ver +', 'listaNegraEmpresa/showListaNegraPor?id=' . $empresa->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'listaNegraEmpresa/download_pdf?id=' . $empresa->getId()) ?>
                            </span>
                        </li>
                    <?php endif ?>
                <?php endif; ?>
            </ul>

            <div class="clean_clear_0_negra"></div>
            <?php if ($empresa->getLista() == "lb"): ?>
                <?php if ($empresa->getConcursoDestacado()->getId()) : ?>
                    <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                        <li><strong>Concurso: </strong><a
                                href='<?php echo url_for('concurso_show', array('id' => $empresa->getConcursoDestacado()->getId())) ?>'><?php echo $empresa->getConcursoDestacado() ?></a>
                        </li>
                    </ul>
                <?php endif ?>
            <?php endif; ?>

            <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px;">
                <li style="width: 98%;"><h3>Comentarios</h3></li>
            </ul>
            <ul class='alerta_cuestionario'>
                <?php $c = 1; ?>
                <?php foreach ($pager as $comentario) : ?>
                    <?php include_partial('listaNegraEmpresa/comentario', array('comentario' => $comentario, 'c' => $c)); ?>
                    <?php $c++; ?>
                <?php endforeach ?>
            </ul>

            <?php if ($pager->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'listaNegraEmpresa/show?page=' . $pager->getFirstPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'listaNegraEmpresa/show?page=' . $pager->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'listaNegraEmpresa/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $empresa->id) ?>
                        <?php if ($page != $pager->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'listaNegraEmpresa/show?page=' . $pager->getNextPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'listaNegraEmpresa/show?page=' . $pager->getLastPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $empresa->id) ?>
                </div>

            <?php endif; ?>

            <?php if (count($pager_pending) > 0) : ?>
                <div class="clean_clear_1_negra"></div>
                <ul class="dragbox-content" style="float: left; width: 97%; min-height: 0px; margin: 5px 5px 0;">
                    <li style="width: 98%;"><h3 style="padding:1px 0 0 0;">Comentarios pendientes</h3></li>
                </ul>
                <h4 style="float: left; width:97%; margin: 3px 0 0 26px">
                    <?php echo format_number_choice('[0]No hay comentarios pendientes|[1]Hay 1 comentario pendiente|[2,+Inf] Hay %n% comentarios pendientes', array('%n%' => count($pager_pending)), count($pager_pending)); ?></h4>
                <ul style="float: left; width: 99%; margin: 12px 0 0 12px;">
                    <?php $c = 1; ?>
                    <?php foreach ($pager_pending as $comentario) : ?>
                        <?php include_partial('listaNegraEmpresa/comentario', array('comentario' => $comentario, 'c' => $c)); ?>
                        <?php $c++; ?>
                    <?php endforeach ?>
                </ul>

            <?php endif ?>

            <?php if ($pager_pending->haveToPaginate()): ?>
                <div class="pagination">
                    <span class="result"><?php echo $pager_pending->getNbResults() . ' resultados'; ?></span>
                    <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'listaNegraEmpresa/show?pg=' . $pager_pending->getFirstPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'listaNegraEmpresa/show?pg=' . $pager_pending->getPreviousPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php foreach ($pager_pending->getLinks() as $page): ?>
                        <?php echo ($page == $pager_pending->getPage()) ? $page : link_to($page, 'listaNegraEmpresa/show?pg=' . $page . '&page=' . $sf_request->getParameter('page', 1) . '&id=' . $empresa->id) ?>
                        <?php if ($page != $pager_pending->getCurrentMaxLink()): ?>
                            -
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'listaNegraEmpresa/show?pg=' . $pager_pending->getNextPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                    <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'listaNegraEmpresa/show?pg=' . $pager_pending->getLastPage() . '&page=' . $sf_request->getParameter('page') . '&id=' . $empresa->id) ?>
                </div>
            <?php endif; ?>


        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista negra', '@lista_negra_empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'lista_negra_empresa_edit', array('id' => $empresa->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .sf_admin_actions{
        float: left;
    }
    .empresa_ul_audit{
        float: left;
        margin: 0 0 0 25px;
        min-height: 50px;
    }
    .empresa_audit{
        float: left;
        width: 99%;
        margin: 0 0 0 12px;
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
    .empresa_ver_comment{
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
        padding-left: 25px !important;
    }
    #sf_admin_container ul.sf_admin_actions {
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    .ver_link{
        float: left;
        /*float: left; width: 100%; */
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        /* float: left;*/
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
                alert('<?php echo __('No puedes destacar más de 10 empresas o entidades de la Lista negra en la Home.') ?>');
                return false;
            }
        });
    });
</script>
