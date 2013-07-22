<div id="content_concursos_buscador">

    <?php $type = sfContext::getInstance()->getRequest()->getParameter('type'); ?>
    <?php if ($type == 'empresa'): ?>
        <?php $type = "Empresa/Entidad"; ?>
    <?php elseif ($audit_type == 'producto'): ?>
        <?php $type = "Producto"; ?>
    <?php endif; ?>
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis auditorías', 'tituloSeccion' => 'Mis auditorías', 'type' => $type)) ?>

    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'empresa'); ?>
            <?php echo link_to('Empresa / Entidad', url_for('concurso-misauditorias', $param), array('title' => 'Auditorías de empresas y entidades realizadas por mí', 'class' => ($audit_type == 'producto' ? '' : 'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'producto'); ?>
            <?php print link_to('Producto', url_for('concurso-misauditorias', $param), array('title' => 'Auditorías de productos realizadas por mí', 'class' => ($audit_type == 'producto' ? 'active' : ''))) ?>
        </span>
    </div>
</div>
<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Has realizado ') . count($pager->getResults()) . ' ' ?>
                <?php if ($audit_type == 'empresa'): ?>
                    <?php echo __('auditorías') ?>
                <?php else: ?>
                    <?php echo __('auditorías') ?>
                <?php endif; ?>
            <?php endif; ?>
        </strong>
    </p>
</div>
<div id="content_concursos">
    <div id="content_concursos_activos">
        <div id="content_concursos_activos_top"></div>
        <div id="content_concursos_activos_middle">
            <div id="content_laslistas_right">

                <?php if (count($pager->getResults())): ?>
                    <?php foreach ($pager->getResults() as $audit_records): ?>
                        <div id="content-results" class="main">
                            <div class="top"></div>
                            <div class="middle">

                                <div id='resultados_empresas'>
                                    <?php include_partial($partial_name, array("audit_record" => $audit_records)) ?>
                                </div>

                            </div>
                            <div class="bottom"></div>
                        </div>

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
                    <?php if ($audit_type == 'empresa'): ?>
                        <strong><?php echo __('Aún no has auditado ninguna empresa o entidad.') ?></strong>
                    <?php else: ?>
                        <strong><?php echo __('Aún no has auditado ningún producto.') ?></strong>
                    <?php endif; ?>
                <?php endif; ?>


            </div>
            <div id="content_concursos_activos_botton"></div>
        </div>
    </div>

</div>
<form method="POST" action="" id="paging_form">
    <input type="hidden" name="page" id="paging_page" value="1"/>
</form>
<form method="POST" action="<?php echo url_for('my_audit_list') ?>" id="audit_list">
    <input type="hidden" name="page"  value="<?php echo $pager->getPage() ?>"/>
    <input type="hidden" name="type" value="<?php echo $audit_type ?>"/>
    <input type="hidden" name="id" value="" id="audit_id"/>
</form>
<script type="text/javascript">
    function pager(page) {
        $('#paging_page').val(page);
        $('#paging_form').submit();
    }

    var e_url = "<?php echo $audit_type == 'empresa' ? '/empresa/auditList' : '/producto/auditList' ?>";

    $(document).ready(function() {
        //submit audit list form when audit button is clicked
        $('.btn-audita').bind('click', function() {
            var audit_id = $(this).data('id');
            $('#audit_id').val(audit_id);
            $('#audit_list').submit();
        });

    });

</script>