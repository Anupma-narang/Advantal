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
	<th class="<?php if($order_by=='producto') echo 'selected '.$order_type?>">
		<?php echo link_to('Producto','concurso/index?tipo=producto&order-by=producto&order-type='.$order_type,array('title' => 'Ordenar por nombre de producto'))?>
	</th>
	<th class="<?php if($order_by=='tipo') echo 'selected '.$order_type?>">
		<?php echo link_to('Tipo de producto','concurso/index?tipo=producto&order-by=tipo&order-type='.$order_type,array('title' => 'Ordenar por tipo de producto'))?>
	</th>
	<th class="<?php if($order_by=='categoria') echo 'selected '.$order_type?>">
		<?php echo link_to('Categoria','concurso/index?tipo=producto&order-by=categoria&order-type='.$order_type,array('title' => 'Ordenar por categoria de concurso'))?>
	</th>
	<th class="<?php if($order_by=='marca') echo 'selected '.$order_type?>">
		<?php echo link_to('Marca','concurso/index?tipo=producto&order-by=marca&order-type='.$order_type,array('title' => 'Ordenar por marca de producto'))?>
	</th>
	<th class="<?php if($order_by=='modelo') echo 'selected '.$order_type?>">
		<?php echo link_to('Modelo','concurso/index?tipo=producto&order-by=modelo&order-type='.$order_type,array('title' => 'Ordenar por modelo de producto'))?>
	</th>
</tr>
</thead>
</table>