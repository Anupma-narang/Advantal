<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribuciones_destacadas/assets') ?>
<div id="sf_admin_container">
<div class="sf_apply sf_apply_settings provider_form">
    <form action="<?php echo url_for('contribuciones_destacadas/contacted?contribucion_id='.$contribucion->id)?>"	method="post">
    <?php echo $form->renderGlobalErrors() ?>
	<?php echo $form->renderHiddenFields() ?>	
        <?php echo $form?>
    	<input type="submit" value="<?php echo __("Enviar") ?>" />
			<?php echo link_to('Volver al Listado','@contribuciones_destacadas')?>
    </form>
</div>
</div>