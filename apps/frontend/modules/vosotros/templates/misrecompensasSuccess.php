<div id="content_concursos_buscador">

    <div id="content_breadcroum">
        <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?>
        >> <?php echo link_to("Vosotros ", "/vosotros", array('title' => 'Vosotros')) ?>
        >> <?php echo link_to('Mis recompensas', "vosotros/" . sfContext::getInstance()->getActionName(), array('title' => 'Mis recompensas')) ?>
        >> <?php echo '<span style="font-weight:bold">Caja</span>'; ?>
    </div>

    <div id="boton_no_activo">
        <span class="concurso_link">

            <a href="/vosotros/misrecompensas" class="active" title="Cobros de caja">Caja</a>    </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <a href="/vosotros/misrecompensasGift" class="" title="Canjes de regalos">Regalos </a>    </span>
    </div>
</div>
<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Has ganado un total de ') . $sf_user->getMoneyInFormat($total_amount) . '€'; ?></strong>
        <?php endif; ?>
    </p>
</div>
<div class="r_blcok">
    <?php $total_amount = 0; ?>
    <?php if (count($pager->getResults())): ?>
        <?php foreach ($pager as $index => $cash_record): ?>
            <div class="r_block">
                <div class="c_block <?php echo 'c_block' . ($index % 3 + 1) ?>">
                    <?php echo $sf_user->getMoneyInFormat($cash_record->getAmount()) . '€'; ?>

                </div>
                <span class="verde"><?php echo date('d/m/Y', strtotime($cash_record->getCreatedAt())) ?></span>
            </div>
            <?php $total_amount = $total_amount + $cash_record->getAmount(); ?>
        <?php endforeach; ?>
    <?php else: ?>

        <div class="border-box-n">
            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right" >
                    <span><?php echo __('Aún no has hecho caja.'); ?></span>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

    <?php endif; ?>

    <div id="accordion">
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