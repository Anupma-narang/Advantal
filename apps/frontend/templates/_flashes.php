<div id="Flash" class="border-box">
<?php if ($sf_user->hasFlash('notice') or $sf_user->hasFlash('nueva_contribucion')): ?>
	<div class="top-left">
		<div class="top-right">
			<div class="close" title="cierra este mensaje"></div>
			<div class="flash_notice">
				<?php echo $sf_user->getFlash('notice',ESC_RAW) ?>
				<?php echo $sf_user->getFlash('nueva_contribucion',ESC_RAW) ?>
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
<?php if((!isset($error_form)) || ($error_form == true)):?>
<?php if ($sf_user->hasFlash('error_form')): ?>
<ul class="flash_error_list">
	<li>
		<?php echo $sf_user->getFlash('error_form',ESC_RAW) ?>
	</li>
</ul>

<?php endif; ?>
<?php endif;?>