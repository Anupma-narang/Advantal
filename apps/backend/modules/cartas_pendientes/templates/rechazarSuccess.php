<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cartas_pendientes/assets') ?>
<div id="sf_admin_container">
<div class="sf_apply sf_apply_settings provider_form">
    <form action="<?php echo url_for('cartas_pendientes/contacted?profesional_letter_id='.$cartas->id)?>"	method="post">
    <?php echo $form->renderGlobalErrors() ?>
	<?php echo $form->renderHiddenFields() ?>
        <fieldset id="sf_fieldset_none">

                <?php
            $fields=array(
              'subject', 'body'
            );
                ?>

                <?php foreach ($fields as $field): ?>
                <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field ?> <?php if ($form[$field]->hasError()): ?>errors<?php endif ?>">
                    <?php echo $form[$field]->renderError()?>
                    <div>
                        <?php echo $form[$field]->renderLabel()?>
                        <div class="content">
                            <?php echo $form[$field]->render() ?>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>

                </fieldset>

</div>
  <ul class='sf_admin_actions'>
        <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado','@cartas_pendientes', array('class' => 'sf_admin_action_cancel'))?>
        <input type="submit" value="<?php echo __("Enviar") ?>" /> </li>
  </ul>
    </form>
</div>
</div>

<script type="text/javascript">
		$("#contact_body").keydown(function(e,key,value) {
				var keycode = (e.keyCode ? e.keyCode : (e.which ? e.which : e.charCode));
				var text = $(this).val();
				if((text.length>1000) && (keycode!=8)){
					return false;
				}
		});
</script>
