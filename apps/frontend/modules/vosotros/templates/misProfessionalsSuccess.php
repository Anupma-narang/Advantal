<?php use_stylesheet('new_lista.css') ?>
<?php use_stylesheet('new_global.css') ?>
<?php include_partial('global/alert_window'); ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>

<?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis profesionales', 'tituloSeccion' => 'Mis profesionales')) ?>

<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Tienes  ') . count($pager->getResults()) . ' ' ?>
                <?php echo __('profesional') ?>
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

                        <div id="resultados_empresas">


                            <?php if (count($pager->getResults())): ?>
                                <!-- render result  -->
                                <?php foreach ($pager->getResults() as $profesional): ?>
                                    <?php
                                    include_partial("vosotros/profesional_record", array("profesional" => $profesional))
                                    ?>
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

                                <strong><?php echo __('Aún no hay ningún concurso creado por ti.') ?></strong>


                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content_concursos_activos_botton"></div>
    </div>

</div>
<form method="POST" action="" id="paging_form">
    <input type="hidden" name="page" id="paging_page" value="1"/>
</form>

<script type='text/javascript'>
    function pager(page) {
        $('#paging_page').val(page);
        $('#paging_form').submit();
    }
    $(function() {
        $('.dynamicBar').sparkline('html', {
            type: 'bar',
            barColor: 'green',
            colorMap: {
                '1': '#429D29',
                '2': '#B41B1D',
                '3': '#BEC1C4',
                '4': '#F65E13'
            },
            tooltipFormat: '{{value:levels}}',
            tooltipValueLookups: {
                levels: {'1': 'Sin medalla', '2': 'Bronze', '3': 'Plata', '4': 'Oro'}
            }
        });

    });

    function setUrl(id, url)
    {
        $("#wholeDiv" + id).attr('onclick', "window.location.href='" + url + "'");
    }

</script>