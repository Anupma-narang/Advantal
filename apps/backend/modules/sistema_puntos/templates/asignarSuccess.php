<form>
	<table>
		<tbody>
			<?php $c = 1?>
			<?php foreach ($puntos as $p):?>
			<tr>
				<td><input type="checkbox" name="option_<?php echo $c?>"
					value="<?php echo $p->getCodigosPuntos()->getCodigo()?>"></td>
				<td><?php echo $p->getDescripcion()?></td>
				<td><strong><?php if(!$p->getIsPositivo()) echo '-'?><?php echo $p->n_puntos?>
				</strong></td>
			</tr>
			<?php $c++?>
			<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">
					<?php echo jq_submit_to_remote('ajax_submit', 'acepta', array(
							'url'      	=> url_for('sistema_puntos/dopuntos?user_id='.$user_id.'&is_positivo='.$is_positivo.'&concurso_id='.$concurso_id),
							'condition'	=> 'comprueba()',
							'update'   => array('success' => 'Asignacion_puntos_inner')
					)) ?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>

<script>					
var comprueba = function(){
	var retorno = false;
//	console.log(retorno);
	$("input:checkbox").each(function(index,value){
		if($(this).is(':checked')){
//			console.log('si');
			retorno = true;
		}
	});
//	console.log(retorno);
	if(!retorno)
		alert('Debes seleccionar al menos una opción');
	return retorno;
};
</script>