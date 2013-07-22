<?php use_javascript('jquery.autocompleter.js')?>
<?php use_stylesheet('jquery.autocompleter.css')?>

<div id="content_concursos_arriba">BUSCAR UN CONCURSO</div>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php echo link_to("Empresa / Entidad", "concurso/index?tipo=empresa&advanced=".$advanced, array("class"=>$tipo=="producto" ? '':'active')) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
             <?php echo link_to("Producto", "concurso/index?tipo=producto&advanced=".$advanced, array("class"=>$tipo=="producto" ? 'active':'')) ?> 
        </span>
    </div>
<form action="<?php echo url_for('concurso/index?advanced='.$advanced.'&tipo='.$tipo)?>" method="POST">
	<div id="buscador_content">
		<div class="border-box" style="width: 625px;">
			<div class="top-left">
				<div class="top-right">				
					<table>
					<tbody>
					<tr>
						<th><?php echo $searchForm['producto']->renderLabel()?></th>
						<th><?php echo $searchForm['marca']->renderLabel()?></th>
						<th><?php echo $searchForm['modelo']->renderLabel()?></th>
					</tr>
					<tr>
						<td><?php echo $searchForm['producto']->renderError()?></td>
						<td><?php echo $searchForm['marca']->renderError()?></td>
						<td><?php echo $searchForm['modelo']->renderError()?></td>
					</tr>
					<tr>
						<td><?php echo $searchForm['producto']->render()?></td>
						<td><?php echo $searchForm['marca']->render()?></td>
						<td><?php echo $searchForm['modelo']->render()?></td>
					</tr>					
					
					<?php if(isset($searchForm['estado_id'])):?>
					<tr>
						<th><?php echo $searchForm['estado_id']->renderLabel()?></th>
						<th><?php echo $searchForm['autor']->renderLabel()?></th>
						<th><?php echo $searchForm['n_participantes']->renderLabel()?></th>
					</tr>
					<tr>
						<td><?php echo $searchForm['estado_id']->renderError()?></td>
						<td><?php echo $searchForm['autor']->renderError()?></td>
						<td><?php echo $searchForm['n_participantes']->renderError()?></td>
					</tr>
					<tr>
						<td><?php echo $searchForm['estado_id']->render()?></td>
						<td><?php echo $searchForm['autor']->render()?></td>
						<td><?php echo $searchForm['n_participantes']->render()?></td>
					</tr>									
					<?php endif;?>							
					</tbody>
					</table>
					<p class="clear" style="text-align: right;">
					<?php if ($advanced=="falso"):?>
						<?php echo link_to("Búsqueda avanzada","concurso/index?advanced=verdadero&tipo=".$tipo)?>
					<?php elseif ($advanced=="verdadero"):?>
						<?php echo link_to("Búsqueda simple","concurso/index?advanced=falso&tipo=".$tipo)?>
					<?php endif;?>
					<?php echo $searchForm->renderHiddenFields()?>
					<input type="submit" value="buscar">
					</p>
 				<!--  </form> --> 
				</div>
			</div>
			<div class="bottom-left">
				<div class="bottom-right"></div>
			</div>
		</div>
	</div>


<div class="order_by_box">
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<table style="width:100%">
					<tbody>
						<tr>
							<td style="width: 33.3%"><?php echo $searchForm['orderby1']->render()?>	</td>
							<td style="width: 33.3%"><?php echo $searchForm['orderby2']->render()?>	</td>
							<td style="width: 33.3%"><?php echo $searchForm['orderby3']->render()?>	</td>							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>
	</div>
</div>

</div>
</form>


<script type="text/javascript">
$().ready(function() {
	$("#SearchForm_producto").autocomplete("<?php echo url_for('ajax_get/productos_by_nombre')?>", {
		width: 260,
		selectFirst: false
	});
	$("#SearchForm_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca')?>", {
		width: 260,
		selectFirst: false
	});
	$("#SearchForm_modelo").autocomplete("<?php echo url_for('ajax_get/productos_by_modelo')?>", {
		width: 260,
		selectFirst: false
	});		
	$("#SearchForm_autor").autocomplete("<?php echo url_for('ajax_get/sfguarduser_by_nombre')?>", {
		width: 260,
		selectFirst: false
	});
	
	$('#SearchForm_orderby1').change(function(){
		$('#SearchForm_orderby2').val(0);		
		$('#SearchForm_orderby3').val(0);
		$('#Buscador_order').submit();
	});
	$('#SearchForm_orderby2').change(function(){
		$('#SearchForm_orderby3').val(0);
		$('#Buscador_order').submit();
	});
	$('#SearchForm_orderby3').change(function(){
		$('#Buscador_order').submit();
	});
});
</script>