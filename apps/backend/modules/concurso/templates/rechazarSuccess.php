<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concurso/assets') ?>
<div id="sf_admin_container">
    <h1><?php echo  __("Sugerir modificaciones a un concurso") ?></h1>
		<div id="sf_admin_content">
    <div class="sf_admin_form">
      <form method="post" action="/backend.php/concurso/contacted/concurso_id/<?php echo $concurso->id ?>">
        <?php //echo $form[$form->getCSRFFieldName()]->render() ?>
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
                                        <?php if($field=='body'):?>
                                            <ul id="Error_max_length_body" class="error_list" style="display:none">
                                                    <li>Has superado el espacio permitido para sugerir modificaciones.</li>
                                            </ul>
                                        <?php endif;?>
                                                                <div>
						<?php echo $form[$field]->renderLabel()?>
						<div class="content">
							<?php echo $form[$field]->render() ?>
						</div>
					</div>
				</div>
				<?php endforeach ?>
				
				</fieldset>
                                <div class="volver_al_listado_contest">
                                    <?php echo link_to('Volver al Listado','@concurso')?>
                                </div>    
				<input type="submit" value="<?php echo __("Enviar") ?>" /> 
			</form>
		</div>
		</div>
</div>