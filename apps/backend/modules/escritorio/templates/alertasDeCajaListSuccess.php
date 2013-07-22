
<?php if (count($alertas_de_caja_pager->getResults()) > 0): ?>
    <?php echo link_to_function('borrar', "$('#alertas_de_caja').load('" . url_for('alertas_de_caja',array('delete' => 'all') ) . "');", array('style' => 'float:right', 'title' => 'Borrar todas las alertas')) ?>
<?php endif; ?>

<ul>
    <?php if (count($alertas_de_caja_pager->getResults()) > 0): ?>
        <h4><?php echo __('Existen'); ?> <?php echo $alertas_de_caja_pager->getNbResults() ?> <?php echo __('alertas pendientes.'); ?></h4><br/> 
        <?php foreach ($alertas_de_caja_pager->getResults() as $alerts_de_caja_record): ?>
            <li><?php echo format_datetime($alerts_de_caja_record->getCreatedAt(), "HH:mm dd/MM/y", "es_ES") ?> - <?php echo link_to($alerts_de_caja_record->getUser()->getUserName(), '/backend.php/colaboradores/' . $alerts_de_caja_record->getUserId() . '/List_ver') . ' ha solicitado hacer caja por la cantidad de ' . $sf_user->getMoneyInFormat($alerts_de_caja_record->getAmount()) . ' €' ?>
                &nbsp;
                <?php echo link_to_function('borrar', "$('#alertas_de_caja_content').load('" . url_for('alertas_de_caja',array('delete' => $alerts_de_caja_record->getId()) ) . "');") ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php echo __('No existen datos.') ?></li>
    <?php endif; ?>
</ul>

<?php if ($alertas_de_caja_pager->haveToPaginate()): ?>
    <div class="pagination" style="text-align:right">
        <?php echo link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), '$("#alertas_de_caja_content").load("escritorio/alertasDeCaja?page=' . $alertas_de_caja_pager->getFirstPage() . '")') ?>	
        <?php echo link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), '$("#alertas_de_caja_content").load("escritorio/alertasDeCaja?page=' . $alertas_de_caja_pager->getPreviousPage() . '")') ?> 
        <?php $links = $alertas_de_caja_pager->getLinks();
        foreach ($links as $page): ?>
            <?php echo ($page == $alertas_de_caja_pager->getPage()) ? $page : link_to_function($page, '$("#alertas_de_caja_content").load("escritorio/alertasDeCaja?page=' . $page . '")') ?>
            <?php if ($page != $alertas_de_caja_pager->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), '$("#alertas_de_caja_content").load("escritorio/alertasDeCaja?page=' . $alertas_de_caja_pager->getNextPage() . '")') ?> 
    <?php echo link_to_function(image_tag('/images/last.png', array('title' => 'Última')), '$("#alertas_de_caja_content").load("escritorio/alertasDeCaja?page=' . $alertas_de_caja_pager->getLastPage() . '")') ?>
    </div>
    <?php
 endif ?>