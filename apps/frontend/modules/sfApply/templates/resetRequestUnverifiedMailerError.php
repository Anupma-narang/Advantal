<?php use_stylesheet('caja.css')?>
<div class="sf_apply_notice">
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<?php echo __(<<<EOM
<p>
Se produjo un error durante el proceso de entrega del correo electrónico. Por favor, inténtalo
de nuevo más tarde.
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