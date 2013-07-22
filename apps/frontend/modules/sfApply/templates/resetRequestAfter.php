<?php use_stylesheet('caja.css')?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div class="sf_apply_notice">
<div id="content_breadcroum">
    <?php echo link_to("inicio", "home/index") ?> >> cambio de contraseña
</div>
<div style="clear:both"></div>
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<?php echo __(<<<EOM
<p style="text-align: justify;">Hemos enviado un mensaje a la dirección de correo electrónico que nos has indicado.<br/>
Por favor, <strong>haz clic en el enlace del mensaje para cambiar tu contraseña</strong>.<br/>
Si no ves el mensaje, asegúrate de revisar la carpeta de “correo no deseado" en tu programa de correo electrónico.</p>

<p>Muchas gracias por tu colaboración.</p>
EOM
				) ?>
						<?php include_partial('sfApply/continue') ?>
		</div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>
	</div>
</div>