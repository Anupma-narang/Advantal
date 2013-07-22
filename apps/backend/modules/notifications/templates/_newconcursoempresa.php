<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<p>Hola %alias%:</p><br/>

<p>Te informamos de que el %created_at%, se ha creado el concurso %concurso_titulo%, creado para %nombre_empresa% en la localidad de %ciudadyprovincia% y en la categoría de %concurso_categoria%.</p>
<p>Esperamos que sea de tu interés y nos gustaría animarte a contribuir con tu Plan de acción para mejorar esta empresa/entidad en tu localidad.</p>
<p>Déjanos recordarte que, cada vez que contribuyes, te recompensamos con 100 puntos que puedes canjear por tus regalos favoritos.</p><br/>

<p>¡Muchas gracias por contribuir!</p> 

<p><a href="%link1%">No quiero recibir más este mensaje</p>
EOM
, array(
		"%alias%" 						=> 	$alias,
		"%created_at%"					=>	format_datetime($created_at, "p", "es_ES"),
  		"%concurso_titulo%" 			=> 	$concurso_titulo,
		"%nombre_empresa%"				=>	$nombre_empresa,
		/*"%provincia%"					=>	$provincia,
		"%ciudad%"						=>	$ciudad,*/
    "%ciudadyprovincia%"  =>	$ciudadyprovincia,
		"%link1%"						=>	url_for('http://auditoscopia.servigenlm.com/vosotros/baja_notificaciones?hash='.$hash.'&tipo=concurso_empresa_value'),
		"%concurso_categoria%"			=> 	$concurso_categoria)) ?>	
