
<ul>
    <?php if (count($profesionales->getResults()) > 0): ?>
        <h4>
            <?php echo format_number_choice('[0]Hay 0 profesionales pendientes.|[1]Hay 1 profesional pendiente.|(1,+Inf]Hay %count% profesionales pendientes.', array('%count%' => $n_profesionales), $n_profesionales)
            ?>
        </h4><br/>
        <?php foreach ($profesionales->getResults() as $profesional): ?>
            <li>
                <?php
                $ssProfFullName = $profesional->getFirstName() . ' ' . $profesional->getLastNameOne() . ' ' . $profesional->getLastNameTwo();

                $ssDate = format_datetime($profesional->getCreatedAt(), "HH:mm dd/MM/y") . '<strong> <a href="' . url_for("@profesional") . '/' . $profesional->getId() . '">' . ($ssProfFullName) . '</a>, </strong>';

                $ssDate .= '<strong>' . $profesional->getCity()->getName() . '</strong>';

                $ssDate .= cp::isStateCapital($profesional->getStates()->getName(), $profesional->getCity()->getName()) ? ', ' : ' (' . $profesional->getStates()->getName() . '), ';

                echo $ssDate .= $profesional->getUser()->getUsername() . '.';
                ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No existen datos.</li>
    <?php endif; ?>
</ul>

<?php if ($profesionales->haveToPaginate()): ?>
    <div class="pagination" style="text-align:right">
        <?php echo link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), '$("#Profesionales_home_content").load("' . url_for('escritorio/get_profesionales_pendientes?page=' . $profesionales->getFirstPage()) . '")') ?>
        <?php echo link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), '$("#Profesionales_home_content").load("' . url_for('escritorio/get_profesionales_pendientes?page=' . $profesionales->getPreviousPage()) . '")') ?>
        <?php $links = $profesionales->getLinks();
        foreach ($links as $page):
            ?>
            <?php echo ($page == $profesionales->getPage()) ? $page : link_to_function($page, '$("#Profesionales_home_content").load("' . url_for('escritorio/get_profesionales_pendientes?page=' . $page) . '")') ?>
            <?php if ($page != $profesionales->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), '$("#Profesionales_home_content").load("' . url_for('escritorio/get_profesionales_pendientes?page=' . $profesionales->getNextPage()) . '")') ?>
    <?php echo link_to_function(image_tag('/images/last.png', array('title' => 'Última')), '$("#Profesionales_home_content").load("' . url_for('escritorio/get_profesionales_pendientes?page=' . $profesionales->getLastPage()) . '")') ?>
    </div>
    <?php

 endif ?>
