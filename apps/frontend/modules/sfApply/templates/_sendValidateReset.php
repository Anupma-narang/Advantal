<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<p>Hola <strong>%USERNAME%</strong>:</p><br/>

<p>Hemos recibido una <strong>solicitud para cambiar tu contraseña</strong> en auditoscopia.<p><br/>
<p>Para cambiar tu contraseña, haz clic %2%.</p><br/>
<p>Si no te funciona, copia y pega la siguiente dirección en tu navegador: %3%</p><br/>

<p>Muchas gracias por tu colaboración.</p>
EOM
, array("%1%" => link_to($sf_request->getHost(), $sf_request->getUriPrefix()),
  "%2%" => link_to("aquí", "sfApply/confirm?validate=$validate", array("absolute" => true)),
  "%3%" => link_to(url_for("sfApply/confirm?validate=$validate", true), "sfApply/confirm?validate=$validate", array("absolute" => true)),
  "%USERNAME%" => $username)) ?>
