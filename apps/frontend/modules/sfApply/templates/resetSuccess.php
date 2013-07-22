<?php use_stylesheet('caja.css')?>
<?php use_stylesheet('forms.css')?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div class="sf_apply sf_apply_reset">

	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<form method="POST" action="<?php echo url_for("sfApply/reset") ?>"
					name="sf_apply_reset_form" id="sf_apply_reset_form">
					<p>
						<?php echo __(<<<EOM
Para <strong>cambiar tu contraseña</strong> necesitas rellenar los siguientes datos:
EOM
						) ?>
					</p>
					<table><tbody>
					<tr>
						<td></td><td><?php echo $form['password']->renderError()?></td>
					</tr>					
					<tr>
						<th><label class="bundle">Tu nueva contraseña</label></th><td><?php echo $form['password']->render()?></td>
					</tr>
					<tr>
						<td></td><td><?php echo $form['password2']->renderError()?></td>
					</tr>					
					<tr>
						<th><label class="bundle">Repite tu nueva contraseña</label></th><td><?php echo $form['password2']->render()?></td>
					</tr>
					</tbody></table>
					<p>
						<?php echo $form->renderHiddenFields()?>					
						<input type="submit" value="<?php echo __("cambia tu contraseña") ?>">	
						<?php echo link_to(__('cancela'), 'sfApply/resetCancel') ?>
					</p>
</form>
			</div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>
	</div>

</div>
