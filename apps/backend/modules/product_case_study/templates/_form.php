<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@product_case_study') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('product_case_study/form_fieldset', array('product_case_study' => $product_case_study, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('product_case_study/form_actions', array('product_case_study' => $product_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<style type="text/css">
    #sf_admin_container label{ padding: 0 !important}
    #sf_admin_container .cke_skin_kama .cke_editor { float: left; margin: 0 !important;}
</style>
<script type="text/javascript" language="javascript">   
    $(document).ready(function(){   
        $('.sf_admin_form_field_description').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
        $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">HasHas superado el espacio permitido para el resumen del caso de éxito.</div>');
        // $('.sf_admin_form_field_comentario_inicial #error_max_length').remove();
    });
</script>