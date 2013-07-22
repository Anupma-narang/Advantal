Hola <strong><?php echo $fullname?></strong>:
En auditoscopia hemos recibido una solicitud de alta de colaborador por tu parte, utilizando este correo electrónico.
Por favor, confirma que este correo electrónico es tuyo haciendo clic <?php echo link_to("aquí", "sfApply/confirm?validate=$validate", array("absolute" => true))?>.
Si no te funciona, copia y pega la siguiente dirección en tu navegador: <?php echo url_for("sfApply/confirm?validate=$validate", true)?>

Muchas gracias por tu colaboración y confianza.