<?php 
	if(!$order_type)
		$order_type='asc';
	elseif($order_type == 'asc')
		$order_type='desc';
	else
		$order_type='asc';
?>

<table>
<thead>
<tr>
	<th class="<?php if($order_by=='nombre') echo 'selected '.$order_type?>">
		<?php echo link_to('Nombre de empresa','concurso/index?tipo=empresa&order-by=nombre&order-type='.$order_type,array('title' => 'Ordenar por nombre de empresa'))?>
	</th>
	<th class="<?php if($order_by=='actividad') echo 'selected '.$order_type?>">
		<?php echo link_to('Actividad de empresa','concurso/index?tipo=empresa&order-by=actividad&order-type='.$order_type,array('title' => 'Ordenar por actividad de empresa'))?>
	</th>
	<th class="<?php if($order_by=='categoria') echo 'selected '.$order_type?>">
		<?php echo link_to('Categoria','concurso/index?tipo=empresa&order-by=categoria&order-type='.$order_type,array('title' => 'Ordenar por categoria de concurso'))?>
	</th>
	<th class="<?php if($order_by=='provincia') echo 'selected '.$order_type?>">
		<?php echo link_to('Provincia','concurso/index?tipo=empresa&order-by=provincia&order-type='.$order_type,array('title' => 'Ordenar por provincia de concurso'))?>
	</th>
	<th class="<?php if($order_by=='localidad') echo 'selected '.$order_type?>">
		<?php echo link_to('Localidad','concurso/index?tipo=empresa&order-by=localidad&order-type='.$order_type,array('title' => 'Ordenar por localidad de concurso'))?>
	</th>
</tr>
</thead>
</table>