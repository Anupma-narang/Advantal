<div id="content_concursos_buscador">

    <div id="content_breadcroum">
        <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?>
        >> <?php echo link_to("Vosotros ", "/vosotros", array('title' => 'Vosotros')) ?>
        >> <?php echo link_to('Mis recompensas', "vosotros/" . sfContext::getInstance()->getActionName(), array('title' => 'Mis recompensas')) ?>
        >> <?php echo '<span style="font-weight:bold">Regalos</span>'; ?>
    </div>

    <div id="boton_no_activo">
        <span class="concurso_link">

            <a href="/vosotros/misrecompensas" class="" title="Cobros de caja">Caja</a>    </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <a href="/vosotros/misrecompensasGift" class="active" title="Canjes de regalos">Regalos </a>    </span>
    </div>
</div>
<div class="rojo_marron float-right">
    <p>
        <?php if (count($pager->getResults())): ?>
            <strong><?php echo __('Has canjeado un total de  ') . count($pager) . __(' regalos.'); ?></strong>
        <?php endif; ?>
    </p>
</div>
<div class="r_blcok">
    <?php $total_points = 0; ?>
    <?php if (count($pager->getResults())): ?>
        <?php foreach ($pager as $index => $gift_record): ?>
            <div class="r_block">
                <div class="">
                    <?php $gift = $gift_record->getGift(); ?>
                    <?php
                    echo image_tag(sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift->getImage(), array('class' => 'gift-image',
                        'data-id' => $gift->getId(),
                        'id' => 'gift_image_' . $gift->getId(),
                    ));
                    ?>


                </div>
                <p><strong><?php echo $gift->getName(); ?></strong></p>
                <p class="azul"><?php echo $gift->getRequirePoints() ?></p>
                <p class="verde"><?php echo date('d/m/Y', strtotime($gift_record->getCreatedAt())) ?></p>
            </div>
            <?php $total_points = $total_points + $gift->getRequirePoints(); ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="border-box-n">
            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right" >
                    <span><?php echo __('Aún no has canjeado ningún regalo.'); ?></span>
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