<ul>
<?php if(count($concursos->getResults())>0):?>
<h4>
<?php echo format_number_choice('[0]Hay 0 concursos.|[1]Hay 1 concurso.|(1,+Inf]Hay %count% concursos.',
        	            		array('%count%' => $n_concursos),$n_concursos)?>
</h4><br/>   
	<?php foreach ($concursos->getResults() as $concurso):?>
		<li>
			<?php echo format_datetime($concurso->getFechaActivacion(), "dd/MM/yyyy", "es_ES")?> <strong><?php echo link_to($concurso->name,"concurso/show?id=".$concurso->id)?></strong>
			
			<?php if($concurso->getConcursoTipoId()==1):?>	<!-- empresa -->
				<?php echo $concurso->getEmpresa()->getName()?>, <?php echo $concurso->getCityandState()?>,
			<?php elseif($concurso->getConcursoTipoId()==2):?>	<!-- producto -->
				<?php echo $concurso->getProducto()->getName()?>, <?php echo $concurso->getProducto()->getMarca()?> <?php echo $concurso->getProducto()->getModelo()?>,
			<?php endif;?> 
			<?php echo $concurso->getUser()->getUserName()?>.
		</li>
	<?php endforeach;?>
<?php else:?>
	<li>No existen datos.</li>
<?php endif;?>
</ul>

<?php if ($concursos->haveToPaginate()): ?>
<div class="pagination" style="text-align:right">
  <?php echo link_to_function(image_tag('/images/first.png',array('title'=>'Primera')),'$("#Concursos60dias_home_content").load("escritorio/get_concursos60dias?page='.$concursos->getFirstPage().'")') ?>	
  <?php echo link_to_function(image_tag('/images/previous.png',array('title'=>'Anterior')), '$("#Concursos60dias_home_content").load("escritorio/get_concursos60dias?page='.$concursos->getPreviousPage().'")') ?> 
  <?php $links = $concursos->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $concursos->getPage()) ? $page : link_to_function($page, '$("#Concursos60dias_home_content").load("escritorio/get_concursos60dias?page='.$page.'")') ?>
    <?php if ($page != $concursos->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_function(image_tag('/images/next.png',array('title'=>'Siguiente')), '$("#Concursos60dias_home_content").load("escritorio/get_concursos60dias?page='.$concursos->getNextPage().'")') ?> 
  <?php echo link_to_function(image_tag('/images/last.png',array('title'=>'Última')), '$("#Concursos60dias_home_content").load("escritorio/get_concursos60dias?page='.$concursos->getLastPage().'")') ?>
</div>
<?php endif ?>
