<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesionales_pendientes/assets') ?>
<div id="sf_admin_container">
<div class="sf_apply sf_apply_settings provider_form">
    <form action="<?php echo url_for('profesionalLista/contacted?profesional_id='.$profesional->id)?>"	method="post">
    <?php echo $form->renderGlobalErrors() ?>
        <?php echo $form->renderHiddenFields() ?>
        <fieldset id="sf_fieldset_none">
        <div class="sf_admin_form_row sf_admin_text">
            <?php if($form['subject']->hasError()):?>
              <ul class="error_list"><li><?php echo $form['subject']->getError();?></li></ul>
            <?php endif;?>
            <div>
                <?php echo $form['subject']->renderLabel();?>
                <div class="content"><?php echo $form['subject']->render();?></div>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <?php if($form['body']->hasError()):?>
              <ul class="error_list"><li><?php echo $form['body']->getError();?></li></ul>
            <?php endif;?>
            <div>
                <?php echo $form['body']->renderLabel();?>
                <div class="content"><?php echo $form['body']->render();?></div>
            </div>
        </div>
        </fieldset>
</div>
  <ul class='sf_admin_actions'>
      <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@profesional_lista', array('class' => 'sf_admin_action_cancel'))?></li>
      <!--li class='sf_admin_action_list'><?php //echo link_to('Volver a profesional en lista', '@profesional_profesionalesListaBlanca', array('class' => 'sf_admin_action_cancel'))?></li-->
      <li class=''><input type="submit" value="<?php echo __("Enviar") ?>" /> </li>
  </ul>
    </form>
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
