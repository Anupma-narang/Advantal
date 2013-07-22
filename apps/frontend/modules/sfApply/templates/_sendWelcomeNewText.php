<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %alias%:
¡Bienvenid@ otra vez a auditoscopia! 
Te recordamos tus datos de colaborador:
Correo electrónico: %email%
Alias: %alias%
No olvides que el resto de colaboradores verán tus contribuciones a través de tu alias (nunca de tu nombre).
Te recordamos que puedes modificar éste o cualquiera de tus otros datos personales en la sección Mi cuenta siempre que lo desees.
Muchas gracias por tu confianza.
EOM
, array(
	"%alias%" => $alias,
	"%email%" => $email,
	"%password" => $password
)) ?>
  