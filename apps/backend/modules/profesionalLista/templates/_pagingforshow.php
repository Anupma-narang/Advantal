<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <span class="result"><?php echo $pager->getNbResults() . ' resultados'; ?></span>
        <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'profesionalLista/show?page=' . $pager->getFirstPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $profesional->id) ?>
        <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'profesionalLista/show?page=' . $pager->getPreviousPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $profesional->id) ?>
        <?php foreach ($pager->getLinks() as $page): ?>
            <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'profesionalLista/show?page=' . $page . '&pg=' . $sf_request->getParameter('pg', 1) . '&id=' . $profesional->id) ?>
            <?php if ($page != $pager->getCurrentMaxLink()): ?>
                -
            <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'profesionalLista/show?page=' . $pager->getNextPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $profesional->id) ?>
        <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'profesionalLista/show?page=' . $pager->getLastPage() . '&pg=' . $sf_request->getParameter('pg') . '&id=' . $profesional->id) ?>
    </div>
<?php endif; ?>