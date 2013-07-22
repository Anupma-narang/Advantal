<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<p>Hola %alias%:</><br/>

<p>Te informamos de que el %created_at%, un colaborador ha contribuido en el concurso %concurso_titulo% que has creado para %nombre_producto% %marca_producto% en la categoría de %concurso_categoria%.</p>
<p>Para verlo, por favor haz clic %aqui%.</p><br/>

<p>¡Muchas gracias por contribuir!</p><br/>

<p><a href="%link1%">No quiero recibir más este mensaje</p>
EOM
, array(
		"%alias%" 						=> 	$alias,
		"%created_at%"					=>	format_datetime($created_at, "p", "es_ES"),
  	"%concurso_titulo%" 			=> 	$concurso_titulo,
		"%nombre_producto%"				=>	$nombre_producto,
		"%marca_producto%"				=>	$marca_producto,
    "%aqui%"						=>	link_to('aquí', "http://auditoscopia.servigenlm.com/concursos/$producto_slug/$slug/$date/$time/plan-de-accion/$number"),
		//"%aqui%"						=>	link_to('aquí', 'http://auditoscopia.servigenlm.com/concurso/show?id='.$concurso_id.'&contribucion_id='.$contribucion_id),
		"%link1%"						=>	url_for('http://auditoscopia.servigenlm.com/vosotros/baja_notificaciones?hash='.$hash.'&tipo=colaborador_contribuye_value'),
		"%concurso_categoria%"			=> 	$concurso_categoria)) ?>	