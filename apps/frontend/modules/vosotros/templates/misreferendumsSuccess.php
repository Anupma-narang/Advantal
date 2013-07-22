<div id="content_concursos_buscador">

    <?php $get_tipo = sfContext::getInstance()->getRequest()->getParameter('tipo'); ?>
    <?php if ($get_tipo == 'empresa' && $list == 'active'): ?>
        <?php $get_tipo = "Empresa/Entidad"; ?>
    <?php elseif ($tipo == 'empresa' && $list == 'history'): ?>
        <?php $get_tipo = "Histórico de Empresa/Entidad"; ?>
    <?php elseif ($tipo == 'producto' && $list == 'active'): ?>
        <?php $get_tipo = "Producto"; ?>
    <?php elseif ($tipo == 'producto' && $list == 'history'): ?>
        <?php $get_tipo = "Histórico de Producto"; ?>
    <?php endif; ?>
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis Referéndums', 'tituloSeccion' => 'Mis Referéndums', 'tipo' => $get_tipo, 'list' => $list)) ?>

    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('tipo' => 'empresa', 'list' => 'active'); ?>

            <?php echo link_to('Empresa / Entidad', url_for('concurso-referendum', $param), array('title' => 'Referéndums de concursos de Empresa y Entidad en los que he contribuido', 'class' => ($tipo == 'producto' ? '' : 'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('tipo' => 'producto', 'list' => 'active'); ?>
            <?php echo link_to('Producto', url_for('concurso-referendum', $param), array('title' => 'Referéndums de concursos de Producto en los que he contribuido', 'class' => ($tipo == 'producto' ? 'active' : ''))) ?>

        </span>
    </div>
</div>
<!-- child buttons view -->
<div>
    <div id="referendum">
        <?php $param = array('tipo' => $tipo, 'list' => 'active'); ?>
        <?php if ($tipo == 'empresa' && ($list == 'active' || $list == 'history')): ?>
            <?php echo link_to('ACTIVOS', url_for('concurso-referendum', $param), array('title' => 'Referéndums activos de concursos de Empresa y Entidad en los que he contribuido')); ?>
        <?php elseif ($tipo == 'producto' && ($list == 'active' || $list == 'history')): ?>
            <?php echo link_to('ACTIVOS', url_for('concurso-referendum', $param), array('title' => 'Referéndums activos de concursos de Producto en los que he contribuido')); ?>
        <?php endif; ?>
    </div>
    <div id="historico_concurso">
        <?php $param = array('tipo' => $tipo, 'list' => 'history'); ?>
        <?php if ($tipo == 'empresa' && ($list == 'active' || $list == 'history')): ?>
            <?php echo link_to('HISTÓRICO', url_for('concurso-referendum', $param), array('title' => 'Histórico de Referéndums de concursos de Empresa y Entidad en los que he contribuido')); ?>
        <?php elseif ($tipo == 'producto' && ($list == 'active' || $list == 'history')): ?>
            <?php echo link_to('HISTÓRICO', url_for('concurso-referendum', $param), array('title' => 'Histórico de Referéndums de concursos de Producto en los que he contribuido')); ?>
        <?php endif; ?>
    </div>
</div>
<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Tienes  ') . count($pager->getResults()) . ' ' ?>
                <?php if ($tipo == 'empresa'): ?>
                    <?php echo $list == 'active' ? __('Referéndums activos') : __('Referéndums en el Histórico') ?>
                <?php else: ?>
                    <?php echo $list == 'active' ? __('Referéndums activos') : __('Referéndums en el Histórico') ?>
                <?php endif; ?>
            <?php endif; ?>
        </strong>
    </p>
</div>
<div id="content_concursos">
    <div id="content_concursos_activos">
        <div id="content_concursos_activos_top"></div>
        <div id="content_concursos_activos_middle">
            <?php if (count($pager->getResults())): ?>
                <?php foreach ($pager->getResults() as $concurso): ?>
                    <?php include_partial("vosotros/concruso", array("concurso" => $concurso, 'option' => $contribution_option, 'is_referendum' => true, 'type' => $tipo, 'list' => $list)) ?>
                <?php endforeach; ?>

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
                <?php if ($list == 'active'): ?>
                    <strong><?php echo __('Aún no has participado en ningún Referéndum.') ?></strong>
                <?php else: ?>
                    <strong><?php echo __('Aún no hay ningún Referéndum en el Histórico.') ?></strong>
                <?php endif; ?>
            <?php endif; ?>


        </div>
        <div id="content_concursos_activos_botton"></div>
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