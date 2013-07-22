<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %alias%:

Te informamos de que, el %created_at%, se ha creado el concurso %concurso_titulo%, creado para %nombre_producto% %marca_producto% en la categoría de %concurso_categoria%.
Esperamos que sea de tu interés y nos gustaría animarte a contribuir con tu Plan de acción para mejorar este producto.
Déjanos recordarte que, cada vez que contribuyes, te recompensamos con 100 puntos que puedes canjear por tus regalos favoritos.

¡Muchas gracias por contribuir! 

EOM
, array(
		"%alias%" 						=> 	$alias,
		"%created_at%"					=>	format_datetime($created_at, "p", "es_ES"),
  		"%concurso_titulo%" 			=> 	$concurso_titulo,
		"%nombre_producto%"				=>	$nombre_producto,
		"%marca_producto%"				=>	$marca_producto,
		"%concurso_categoria%"			=> 	$concurso_categoria)) ?>	