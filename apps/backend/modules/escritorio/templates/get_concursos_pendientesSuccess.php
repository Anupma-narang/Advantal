<ul>
<?php if(count($concursos->getResults())>0):?>
<h4>
<?php echo format_number_choice('[0]Hay 0 concursos pendientes.|[1]Hay 1 concurso pendiente.|(1,+Inf]Hay %count% concursos pendientes.',
        	            		array('%count%' => $n_concursos),$n_concursos)?>
</h4><br/>   
	<?php foreach ($concursos->getResults() as $concurso):?>
		<li>
			<?php echo format_datetime($concurso->getCreatedAt(), "HH:mm dd/MM/y", "es_ES")?> <?php //echo link_to($concurso->name,"concurso/show?id=".$concurso->id)?><?php echo link_to($concurso->name,"concursos_pendientes/show?id=".$concurso->id)?>
      
			<?php if($concurso->getConcursoTipoId()==1):?>	<!-- empresa -->
				<?php echo "<b>".$concurso->getEmpresa()->getName()."</b>"?>, <?php echo $concurso->getCityandState()?>
			<?php elseif($concurso->getConcursoTipoId()==2):?>	<!-- producto -->
				<?php echo '<b>'.$concurso->getProducto()->getName().'</b>'?> <?php echo '<b>'.$concurso->getProducto()->getMarca().'</b>'?> <?php echo '<b>'.$concurso->getProducto()->getModelo().'</b>'?>
			<?php endif;?> 
			, <?php echo $concurso->getUser()->getUserName()?>.
		</li>
	<?php endforeach;?>
<?php else:?>
	<li>No existen datos.</li>
<?php endif;?>
</ul>

<?php if ($concursos->haveToPaginate()): ?>
<div class="pagination" style="text-align:right">
  <?php echo link_to_function(image_tag('/images/first.png',array('title'=>'Primera')),'$("#Concursos_home_content").load("escritorio/get_concursos_pendientes?page='.$concursos->getFirstPage().'")') ?>	
  <?php echo link_to_function(image_tag('/images/previous.png',array('title'=>'Anterior')), '$("#Concursos_home_content").load("escritorio/get_concursos_pendientes?page='.$concursos->getPreviousPage().'")') ?> 
  <?php $links = $concursos->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $concursos->getPage()) ? $page : link_to_function($page, '$("#Concursos_home_content").load("escritorio/get_concursos_pendientes?page='.$page.'")') ?>
    <?php if ($page != $concursos->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_function(image_tag('/images/next.png',array('title'=>'Siguiente')), '$("#Concursos_home_content").load("escritorio/get_concursos_pendientes?page='.$concursos->getNextPage().'")') ?> 
  <?php echo link_to_function(image_tag('/images/last.png',array('title'=>'Última')), '$("#Concursos_home_content").load("escritorio/get_concursos_pendientes?page='.$concursos->getLastPage().'")') ?>
</div>
<?php endif ?>
