<?php if (count($gift_alert_pager->getResults()) > 0): ?>
    <?php echo link_to_function('borrar', "$('#alertas_de_canje').load('" . url_for('alertas_de_canje',array('delete' => 'all') ) . "');", array('style' => 'float:right', 'title' => 'Borrar todas las alertas')) ?>
<?php endif; ?>

<ul>
    <?php if (count($gift_alert_pager->getResults()) > 0): ?>
        <h4><?php echo __('Existen'); ?> <?php echo $gift_alert_pager->getNbResults() ?> <?php echo __('alertas pendientes.'); ?></h4><br/> 
        <?php foreach ($gift_alert_pager->getResults() as $c): ?>
      <li><?php echo format_datetime($c->getCreatedAt(), "HH:mm dd/MM/y", "es_ES") ?> -
        <?php if($c->getUserRelatedId()):?>
          <?php $user = $c->getSfGuardUser();?>
          <?php echo link_to($user->getUsername(),  url_for('colaboradores_list', array('id' => $user->getId())));?>
        <?php endif;?>
        <?php echo html_entity_decode($c->message) ?>
        &nbsp;
        <?php echo link_to_function('borrar', "$('#Alertas_home_content').load('" . url_for('escritorio/get_alertas?delete=' . $c->getId()) . "');") ?> 
      </li>
    <?php endforeach; ?>
    <?php else: ?>
        <li><?php echo __('No existen datos.') ?></li>
    <?php endif; ?>
</ul>

<?php if ($gift_alert_pager->haveToPaginate()): ?>
    <div class="pagination" style="text-align:right">
        <?php echo link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), '$("#alertas_de_canje_content").load("escritorio/alertasDeCaja?page=' . $gift_alert_pager->getFirstPage() . '")') ?>	
        <?php echo link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), '$("#alertas_de_canje_content").load("escritorio/alertasDeCaja?page=' . $gift_alert_pager->getPreviousPage() . '")') ?> 
        <?php $links = $gift_alert_pager->getLinks();
        foreach ($links as $page): ?>
            <?php echo ($page == $gift_alert_pager->getPage()) ? $page : link_to_function($page, '$("#alertas_de_canje_content").load("escritorio/alertasDeCaja?page=' . $page . '")') ?>
            <?php if ($page != $gift_alert_pager->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), '$("#alertas_de_canje_content").load("escritorio/alertasDeCaja?page=' . $gift_alert_pager->getNextPage() . '")') ?> 
    <?php echo link_to_function(image_tag('/images/last.png', array('title' => 'Última')), '$("#alertas_de_canje_content").load("escritorio/alertasDeCaja?page=' . $gift_alert_pager->getLastPage() . '")') ?>
    </div>
    <?php
 endif ?>