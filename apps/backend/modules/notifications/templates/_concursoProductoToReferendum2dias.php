<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %alias%:

Te informamos de que el concurso %concurso_titulo%, creado para %concurso_producto_nombre% %concurso_producto_marca% en la categoría de [Categoría del concurso], finaliza en el plazo de 3 días.
Nos gustaría recordarte que, con tu votación, puedes elegir las contribuciones de más valor para el producto en concurso y con las que puedes participar en beneficio.
Además, sólo por votar te recompensamos con 50 puntos para canjear por tus regalos favoritos.

¡Vota ahora!
EOM
, array(
		"%alias%" 						=> $alias,
  		"%concurso_titulo%" 			=> $concurso_titulo,
		"%concurso_producto_nombre%" 	=> $concurso_producto_nombre,
		"%concurso_producto_marca%" 	=> $concurso_producto_marca,
		"%concurso_categoria%"			=> $concurso_categoria)) ?>		