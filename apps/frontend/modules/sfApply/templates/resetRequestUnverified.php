<?php use_stylesheet('caja.css')?>
<div class="sf_apply_notice">
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<p>
					<?php echo(__(<<<EOM
Esa cuenta nunca fue verificada. Debes verificar la cuenta antes de poder iniciar sesión o, si
es necesario, restablecer la contraseña. Hemos reenviado un correo electrónico de verificación, que contiene
instrucciones para verificar tu cuenta. Si no ves el correo electrónico, por favor, asegúrate de revisar
la carpeta "spam" de tu programa de correo electrónico.
EOM
					)) ?>
							</p>
<?php include_partial('sfApply/continue') ?>
			</div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>
	</div>
</div>
