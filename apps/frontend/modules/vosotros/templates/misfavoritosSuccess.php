<div id="content_concursos_buscador">

    <?php $type = sfContext::getInstance()->getRequest()->getParameter('type'); ?>
    <?php if ($type == 'company_contest'): ?>
        <?php $type = "Concursos de Empresa/Entidad"; ?>
    <?php elseif ($favourit_type == 'product_contest'): ?>
        <?php $type = "Concursos de Producto"; ?>
    <?php elseif ($favourit_type == 'company'): ?>
        <?php $type = "Empresas/Entidades"; ?>
    <?php elseif ($favourit_type == 'product'): ?>
        <?php $type = "Productos"; ?>
    <?php elseif ($favourit_type == 'gift'): ?>
        <?php $type = "Regalos"; ?>
    <?php endif; ?>
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis favoritos', 'tituloSeccion' => 'Mis favoritos', 'type' => $type)) ?>

    <div id="boton_no_activo">
        <span class="concurso_link">

            <?php $param = array('type' => 'company_contest'); ?>
            <?php print link_to('Concursos de Empresa/Entidad', url_for('favourit', $param), array('title' => 'Concursos de Empresa y Entidad favoritos', 'class' => ($favourit_type == 'company_contest' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'product_contest'); ?>
            <?php print link_to('Concursos de Producto ', url_for('favourit', $param), array('title' => 'Concursos de Producto favoritos', 'class' => ($favourit_type == 'product_contest' ? 'active' : ''))) ?>
        </span>
    </div>


    <div id="boton_no_activo">
        <span class="concurso_link">

            <?php $param = array('type' => 'company'); ?>
            <?php print link_to('Empresas/Entidades', url_for('favourit', $param), array('title' => 'Empresas y Entidades recomendadas favoritas', 'class' => ($favourit_type == 'company' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'product'); ?>
            <?php print link_to('Productos', url_for('favourit', $param), array('title' => 'Productos recomendados favoritos', 'class' => ($favourit_type == 'product' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'gift'); ?>
            <?php print link_to('Regalos', url_for('favourit', $param), array('title' => 'Regalos del Escapate favoritos', 'class' => ($favourit_type == 'gift' ? 'active' : ''))) ?>
        </span>
    </div>
</div>
<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Has añadido ') . count($pager->getResults()) . ' ' ?>
                <?php echo $header_message; ?>
            <?php endif; ?>
        </strong>
    </p>
</div>
<div id="content_laslistas_right">
    <div id="content_concursos" class="main">
        <div id="content_concursos_activos" >
            <div id="content_concursos_activos_top" ></div>
            <div id="content_concursos_activos_middle" class="middle">
                <?php if (count($pager->getResults())): ?>
                    <?php foreach ($pager->getResults() as $favourit_record): ?>
                        <?php include_partial($favourit_prtial, array($favourit_object => $favourit_record, 'option' => $favourit_option, 'from' => $from)) ?>
                    <?php endforeach; ?>

                    <?php if ($pager->haveToPaginate()): ?>
                        <div class="pagination">
                            <?php print link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), 'pager(' . $pager->getFirstPage() . ')') ?>
                            <?php print link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), 'pager(' . $pager->getPreviousPage() . ')') ?>
                            <?php
                            $pages = array();
                            foreach ($pager->getLinks() as $page) {
                                $pages[] = ($page == $pager->getPage()) ? $page : link_to_function($page, 'pager(' . $page . ')');
                            }
                            print implode(' - ', $pages);
                            ?>
                            <?php print link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), 'pager(' . $pager->getNextPage() . ')') ?>
                            <?php print link_to_function(image_tag('/images/last.png', array('title' => 'Última')), 'pager(' . $pager->getLastPage() . ')') ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <strong><?php echo $empty_message ?></strong>
                <?php endif; ?>


            </div>
            <div id="content_concursos_activos_botton"></div>
        </div>

    </div>
</div>
<form method="POST" action="" id="paging_form">
    <input type="hidden" name="page" id="paging_page" value="1"/>
</form>

<script type="text/javascript">
    function pager(page) {
        $('#paging_page').val(page);
        $('#paging_form').submit();
    }
</script>