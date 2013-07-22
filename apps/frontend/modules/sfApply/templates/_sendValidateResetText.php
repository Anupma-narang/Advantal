<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
Hola %USERNAME%:

Hemos recibido una solicitud para cambiar tu contraseña en auditoscopia.
Para cambiar tu contraseña, haz clic aquí %2%.
Si no te funciona, copia y pega la siguiente dirección en tu navegador: %2%

Muchas gracias por tu colaboración.		
EOM
, array("%1%" => url_for($sf_request->getUriPrefix()),
  "%2%" => url_for("sfApply/confirm?validate=$validate", true),
  "%USERNAME%" => $username)) ?>


