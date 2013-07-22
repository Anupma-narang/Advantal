<div id="Flash" class="border-box">
<?php if ($sf_user->hasFlash('notice') or $sf_user->hasFlash('nueva_contribucion')): ?>
	<div class="top-left">
		<div class="top-right">
			<div class="close" title="cierra este mensaje"></div>
			<div class="flash_notice">
				<?php echo $sf_user->getFlash('nueva_contribucion',ESC_RAW) ?>
                                <?php echo $sf_user->getFlash('notice',ESC_RAW) ?>
			</div>
		</div>
	</div>
	<div class="bottom-left">
		<div class="bottom-right"></div>
	</div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
	<div class="top-left">
		<div class="top-right">
			<div class="close" title="cierra este mensaje"></div>
			<div class="flash_error">
				<?php echo $sf_user->getFlash('error',ESC_RAW) ?>
			</div>
		</div>
	</div>
	<div class="bottom-left">
		<div class="bottom-right"></div>
	</div>
<?php endif; ?>
</div>