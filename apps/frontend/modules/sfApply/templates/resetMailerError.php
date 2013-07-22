<?php use_helper('I18N') ?>
<div class="sf_apply_notice">
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<?php echo __(<<<EOM
<p>
Ocurrió un error al enviar el correo electrónico. Por favor intentalo más tarde.
</p>
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
