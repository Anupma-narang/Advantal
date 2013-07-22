<?php use_stylesheet('caja.css')?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div class="sf_apply_notice">
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<?php echo __(<<<EOM
<p>
Esta cuenta se ha dado de baja. Si quieres reactivarla, por favor contacta con nosotros.
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