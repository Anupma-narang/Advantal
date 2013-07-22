
<ul>
<?php if(count($cartas->getResults()) > 0):?>
<h4>
<?php echo format_number_choice('[0]Hay 0 carta pendientes.|[1]Hay 1 carta pendiente.|(1,+Inf]Hay %count% cartas pendientes.',
        	            		array('%count%' => $n_cartas),$n_cartas)?>
</h4><br/>
	<?php foreach ($cartas->getResults() as $carta):?>
		<li>
            <?php
            $username = $carta->getUser()->getUsername();
            $ssProfFullName = $carta->Profesional->getFirstName().' '.$carta->Profesional->getLastNameOne().' '.$carta->Profesional->getLastNameTwo();

            $ssRecommand = '<a href="cartas_pendientes/'.$carta->getId().'">'.(($carta->getProfesionalLetterTypeId() == 1) ? 'recomendado' : 'desaprobado').'</a>';

            //$ssDate = format_datetime($carta->getCreatedAt(), "HH:mm d/M/y").'<strong> <a href="colaboradores/'.$carta->getUserId().'/List_ver">'.($username).'</a></strong>';
            $ssDate = format_datetime($carta->getCreatedAt(), "HH:mm dd/MM/y").' '.$username;

            $ssProfFullName = '<a href="profesionales/'.$carta->Profesional->getId().'">'.($ssProfFullName).'</a></strong>';

            $ssCity = $carta->Profesional->getCity()->getName();
            $ssCity .= cp::isStateCapital($carta->Profesional->getStates()->getName(), $carta->Profesional->getCity()->getName()) ? '.' : ' ('.$carta->Profesional->getStates()->getName() .').';
            //$ssCity = Profesional::compateCity($carta->Profesional);
            $ssTipo = $carta->Profesional->getProfesionalTipoTres()->getId() ? $carta->Profesional->getProfesionalTipoTres() : $carta->Profesional->getProfesionalTipoDos();
            $ssDate .= ' ha '.$ssRecommand.' al profesional '.$ssProfFullName.' de la actividad <strong>'.$ssTipo.'</strong> en '.$ssCity;

            echo $ssDate;
            ?>
          </li>
	<?php endforeach;?>
<?php else:?>
	<li>No existen datos.</li>
<?php endif;?>
</ul>

<?php if ($cartas->haveToPaginate()): ?>
<div class="pagination" style="text-align:right">
  <?php echo link_to_function(image_tag('/images/first.png',array('title'=>'Primera')),'$("#Cartas_home_content").load("'.url_for('escritorio/get_cartas_pendientes?page='.$cartas->getFirstPage()).'")') ?>
  <?php echo link_to_function(image_tag('/images/previous.png',array('title'=>'Anterior')), '$("#Cartas_home_content").load("'.url_for('escritorio/get_cartas_pendientes?page='.$cartas->getPreviousPage()).'")') ?>
  <?php $links = $cartas->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $cartas->getPage()) ? $page : link_to_function($page, '$("#Cartas_home_content").load("'.url_for('escritorio/get_cartas_pendientes?page='.$page).'")') ?>
    <?php if ($page != $cartas->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_function(image_tag('/images/next.png',array('title'=>'Siguiente')), '$("#Cartas_home_content").load("'.url_for('escritorio/get_cartas_pendientes?page='.$cartas->getNextPage()).'")') ?>
  <?php echo link_to_function(image_tag('/images/last.png',array('title'=>'Última')), '$("#Cartas_home_content").load("'.url_for('escritorio/get_cartas_pendientes?page='.$cartas->getLastPage()).'")') ?>
</div>
<?php endif ?>
