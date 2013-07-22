<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %alias%:

Te informamos de que el concurso %concurso_titulo%, creado para %concurso_producto_nombre% %concurso_producto_marca% en la categoría de [Categoría del concurso], finaliza en el plazo de 3 días.
Nos gustaría recordarte que, si deseas volver a contribuir en este concurso con una nueva contribución, ¡se te acaba el tiempo!
Igualmente, queremos animarte a participar en el Referéndum, que comienza al finalizar el mismo, para elegir las mejores contribuciones, con lo que puedes ganar 50 puntos para canjear por tus regalos favoritos.

¡Muchas gracias por contribuir!
EOM
, array(
		"%alias%" 						=> $alias,
  		"%concurso_titulo%" 			=> $concurso_titulo,
		"%concurso_producto_nombre%" 	=> $concurso_producto_nombre,
		"%concurso_producto_marca%" 	=> $concurso_producto_marca,
		"%concurso_categoria%"			=> $concurso_categoria)) ?>		