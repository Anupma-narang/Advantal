<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %alias%:

Te informamos de que el concurso %concurso_titulo%, creado para %concurso_empresa_nombre% en la localidad de %concurso_ciudadyprovincia% y en la categoría de %concurso_categoria%, finaliza en un plazo de 2 días y todavía no has votado.
Nos gustaría recordarte que, con tu votación, puedes elegir las contribuciones de más valor para la empresa o entidad en concurso y con las que puedes participar en beneficio.
Además, sólo por votar te recompensamos con 50 puntos para canjear por tus regalos favoritos.

¡Vota ahora!
EOM
, array(
		"%alias%" 						=> $alias,
  		"%concurso_titulo%" 			=> $concurso_titulo,
  		"%concurso_empresa_nombre%" 	=> $concurso_empresa_nombre,
		/*"%concurso_empresa_provincia%" 	=> $concurso_empresa_provincia,
		"%concurso_empresa_ciudad%"		=> $concurso_empresa_ciudad,*/
    "%concurso_ciudadyprovincia%"  =>	$ciudadyprovincia,
		"%concurso_categoria%"			=> $concurso_categoria)) ?>		