<ul>
<?php if(count($contribuciones->getResults())>0):?>
<h4>
<?php echo format_number_choice('[0]Hay 0 contribuciones pendientes.|[1]Hay 1 contribución pendiente.|(1,+Inf]Hay %count% contribuciones pendientes.',
        	            		array('%count%' => $n_contribuciones),$n_contribuciones)?>
</h4><br/>        	            		
	<?php foreach ($contribuciones->getResults() as $contribucion):?>
		<?php $concurso = $contribucion->getConcurso()?>
		<li>
			<?php echo format_datetime($contribucion->getCreatedAt(), "HH:mm dd/MM/y", "es_ES")?> <strong><?php echo link_to($contribucion->name,"contribuciones_pendientes/show?id=".$contribucion->id)?></strong>
			
			<?php if($concurso->getConcursoTipoId()==1):?>	<!-- empresa -->
				<?php echo '<b>'.$concurso->getEmpresa()->getName().'</b>'?>, <?php echo $concurso->getCityandState()?>,
			<?php elseif($concurso->getConcursoTipoId()==2):?>	<!-- producto -->
				<?php echo '<b>'.$concurso->getProducto()->getName().'</b>'?> <?php echo '<b>'.$concurso->getProducto()->getMarca().'</b>'?> <?php echo '<b>'.$concurso->getProducto()->getModelo().'</b>'?>
			<?php endif;?>
			, <?php echo $contribucion->getUser()->getUserName()?>.
      
			<?php if($concurso->getDestacado()):?>
				<?php echo image_tag('/images/atention-icon.png',array('title' => 'Concurso Destacado'))?>
			<?php endif;?>			
		</li>
	<?php endforeach;?>
<?php else:?>
	<li>No existen datos.</li>
<?php endif;?>
</ul>

<?php if ($contribuciones->haveToPaginate()): ?>
<div class="pagination" style="text-align:right">
  <?php echo link_to_function(image_tag('/images/first.png',array('title'=>'Primera')),'$("#Contribuciones_home_content").load("escritorio/get_contribuciones_pendientes?page='.$contribuciones->getFirstPage().'")') ?>	
  <?php echo link_to_function(image_tag('/images/previous.png',array('title'=>'Anterior')), '$("#Contribuciones_home_content").load("escritorio/get_contribuciones_pendientes?page='.$contribuciones->getPreviousPage().'")') ?> 
  <?php $links = $contribuciones->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $contribuciones->getPage()) ? $page : link_to_function($page, '$("#Contribuciones_home_content").load("escritorio/get_contribuciones_pendientes?page='.$page.'")') ?>
    <?php if ($page != $contribuciones->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_function(image_tag('/images/next.png',array('title'=>'Siguiente')), '$("#Contribuciones_home_content").load("escritorio/get_contribuciones_pendientes?page='.$contribuciones->getNextPage().'")') ?> 
  <?php echo link_to_function(image_tag('/images/last.png',array('title'=>'Última')), '$("#Contribuciones_home_content").load("escritorio/get_contribuciones_pendientes?page='.$contribuciones->getLastPage().'")') ?>
</div>
<?php endif ?>
