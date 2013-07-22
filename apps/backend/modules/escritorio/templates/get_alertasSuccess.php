<?php if (count($alertas->getResults()) > 0): ?>
    <?php echo link_to_function('borrar', "$('#Alertas_home_content').load('" . url_for('escritorio/get_alertas?delete=all') . "');", array('style' => 'float:right', 'title' => 'Borrar todas las alertas')) ?>
<?php endif; ?>

<ul>
    <?php if (count($alertas->getResults()) > 0): ?>
        <h4>Hay <?php echo $n_alertas ?> alertas pendientes.</h4><br/> 
        <?php foreach ($alertas->getResults() as $c): ?>
            <li><?php echo format_datetime($c->getCreatedAt(), "HH:mm dd/MM/y", "es_ES") ?> -
                <?php if ($c->getUserRelatedId()): ?>
                    <?php $user = $c->getSfGuardUser(); ?>
                    <?php echo link_to($user->getUsername(), url_for('colaboradores_list', array('id' => $user->getId()))); ?>
                <?php endif; ?>
                <?php echo html_entity_decode($c->message) ?>
                &nbsp;
                <?php echo link_to_function('borrar', "$('#Alertas_home_content').load('" . url_for('escritorio/get_alertas?delete=' . $c->getId()) . "');") ?> 
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No existen datos.</li>
    <?php endif; ?>
</ul>

<?php if ($alertas->haveToPaginate()): ?>
    <div class="pagination" style="text-align:right">
        <?php echo link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), '$("#Alertas_home_content").load("escritorio/get_alertas?page=' . $alertas->getFirstPage() . '")') ?>	
        <?php echo link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), '$("#Alertas_home_content").load("escritorio/get_alertas?page=' . $alertas->getPreviousPage() . '")') ?> 
        <?php $links = $alertas->getLinks();
        foreach ($links as $page): ?>
            <?php echo ($page == $alertas->getPage()) ? $page : link_to_function($page, '$("#Alertas_home_content").load("escritorio/get_alertas?page=' . $page . '")') ?>
            <?php if ($page != $alertas->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), '$("#Alertas_home_content").load("escritorio/get_alertas?page=' . $alertas->getNextPage() . '")') ?> 
        <?php echo link_to_function(image_tag('/images/last.png', array('title' => 'Última')), '$("#Alertas_home_content").load("escritorio/get_alertas?page=' . $alertas->getLastPage() . '")') ?>
    </div>
    <?php

 endif ?>