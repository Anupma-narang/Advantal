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
	<td style="width:33.3%">
		<select name="order_1" id="order_1"></select>
	</td>
	<td style="width:33.3%">
		<select id="order_2" disabled="disabled"><option value="">Selecciona una opción</option></select>
	</td>
	<td style="width:33.3%">
		<select id="order_3" disabled="disabled"><option value="">Selecciona una opción</option></select>
	</td>
</tr>
</thead>
</table>

<script type="text/javascript">
var opciones_1 = ["Selecciona una opción", "Nombre de la empresa", "Categoria de concurso", "Actividad de la empresa", "Provincia", "Localidad"];
var opciones_2 = new Array();
var opciones_3 = new Array();

$(document).ready(function() {
	$.each(opciones_1,function(index, value){
		var html = '<option value="'+index+'"';
		if(index==<?php echo $order_by[0]?>)
			html += ' selected ';
		html += '>'+value+'</option>';
		
		$('#order_1').append(html);			
	});
});

/*$('#order_1').change(function(){
	opciones_2 = opciones_1.slice(0);
	if($('#order_1').val()!=0)
		opciones_2.splice($('#order_1').val(), 1);
	$('option', $('#order_2')).remove();
	$.each(opciones_2,function(index, value){
		if(value)
			$('#order_2').append('<option value="'+index+'">'+value+'</option>');
	});	
	$('#order_2').removeAttr('disabled');
	$('option', $('#order_3')).remove();	
	$('#order_3').append('<option value="">Selecciona una opción</option>');
	$('#order_3').attr('disabled','disabled');
});*/

$('#order_2').change(function(){
	opciones_3 = opciones_2.slice(0);
	if($('#order_2').val()!=0)
		opciones_3.splice($('#order_2').val(), 1);
	$('option', $('#order_3')).remove();
	$.each(opciones_3,function(index, value){
		if(value)
			$('#order_3').append('<option value="'+index+'">'+value+'</option>');
	});	
	$('#order_3').removeAttr('disabled');
});

$('#order_1').change(function(){
	window.location = "/concurso/index?orderby1="+$(this).val();
});
</script>
