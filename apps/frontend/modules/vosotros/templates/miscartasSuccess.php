<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('new_lista.css') ?>
<?php use_stylesheet('new_global.css') ?>

<!-- parent buttons view -->
<div id="content_concursos_buscador">

    <?php $type = sfContext::getInstance()->getRequest()->getParameter('type'); ?>
    <?php if ($type == 'recommended'): ?>
        <?php $type = "Mis cartas de recomendación"; ?>
    <?php elseif ($cart_type == 'disaproved'): ?>
        <?php $type = "Mis cartas de desaprobación"; ?>
    <?php endif; ?>
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis cartas', 'tituloSeccion' => 'Mis cartas', 'type' => $type)) ?>

    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'recommended'); ?>

            <?php echo link_to('Recomendaciones', url_for('my-carts', $param), array('title' => 'Cartas de recomendación creadas por mí', 'class' => ($cart_type == 'recommended' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'disaproved'); ?>
            <?php echo link_to('Desaprobaciones', url_for('my-carts', $param), array('title' => 'Cartas de desaprobación creadas por mí', 'class' => ($cart_type == 'disaproved' ? 'active' : ''))) ?>
        </span>
    </div>
</div>

<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Tienes  ') . count($pager->getResults()) . ' ' ?>
                <?php if ($cart_type == 'recommended'): ?>
                    <?php echo __('Recomendaciones') ?>
                <?php else: ?>
                    <?php echo __('Desaprobaciones') ?>
                <?php endif; ?>
            <?php endif; ?>
        </strong>
    </p>
</div>
<!-- record list -->
<div id="content_concursos">
    <div id="content_concursos_activos">
        <div id="content_concursos_activos_top"></div>
        <div id="content_concursos_activos_middle">
            <div id="content_laslistas_right">
                <div class="main" id="content-results">
                    <div class="top"></div>
                    <div class="middle">
                        <?php if (count($pager->getResults())): ?>
                            <!-- render result  -->
                            <?php foreach ($pager->getResults() as $profesional): ?>
                                <?php include_partial("vosotros/profesional_record", array("profesional" => $profesional, 'list_type' => $cart_type)) ?>
                            <?php endforeach; ?>
                            <!-- include pagination` -->
                            <?php if ($pager->haveToPaginate()): ?>
                                <div class="pagination">
                                    <?php echo link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), 'pager(' . $pager->getFirstPage() . ')') ?>
                                    <?php echo link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), 'pager(' . $pager->getPreviousPage() . ')') ?>
                                    <?php
                                    $pages = array();
                                    foreach ($pager->getLinks() as $page) {
                                        $pages[] = ($page == $pager->getPage()) ? $page : link_to_function($page, 'pager(' . $page . ')');
                                    }
                                    echo implode(' - ', $pages);
                                    ?>
                                    <?php echo link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), 'pager(' . $pager->getNextPage() . ')') ?>
                                    <?php echo link_to_function(image_tag('/images/last.png', array('title' => 'Última')), 'pager(' . $pager->getLastPage() . ')') ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($cart_type == 'recommended'): ?>
                                <strong><?php echo __('Aún no has escrito ninguna carta de recomendación.') ?></strong>
                            <?php else: ?>
                                <strong><?php echo __('Aún no has escrito ninguna carta de desaprobación.') ?></strong>
                            <?php endif; ?>


                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div id="content_concursos_activos_botton"></div>
    </div>

</div>
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <div ><strong id="message_header"></strong></div>
                <div id="message_content"></div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>
<form method="POST" action="" id="paging_form">
    <input type="hidden" name="page" id="paging_page" value="1"/>
</form>
<script type="text/javascript">
    $("#user_message_ancor").fancybox({padding: 5});
    function pager(page) {
        $('#paging_page').val(page);
        $('#paging_form').submit();
    }
    function showDesc(header, content_id) {
        $('#message_header').html(header);
        $('#message_content').html($('#desc-' + content_id).html());
        $("#user_message_ancor").trigger('click');

    }
</script>